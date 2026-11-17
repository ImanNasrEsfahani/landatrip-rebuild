import { expect, request, test } from '@playwright/test';

const baseURL = process.env.STAGING_BASE_URL || 'https://localhost:18443';
const user = process.env.STAGING_ACCESS_USER || 'staging';
const password = process.env.STAGING_ACCESS_PASSWORD || '';
const basic = `Basic ${Buffer.from(`${user}:${password}`).toString('base64')}`;

test('Apache requires Basic credentials before reaching any upstream', async () => {
  const anonymous = await request.newContext({ baseURL, ignoreHTTPSErrors: true });
  expect((await anonymous.get('/healthz')).status()).toBe(401);
  expect((await anonymous.get('/__proxy_probe')).status()).toBe(401);
  expect((await anonymous.get('/build/manifest.json')).status()).toBe(401);
  const customOnly = await anonymous.get('/__proxy_probe', {
    headers: { 'X-Staging-Api-Authorization': 'Bearer isolated-probe-token' },
  });
  expect(customOnly.status()).toBe(401);
  const wrong = await anonymous.get('/healthz', {
    headers: { Authorization: `Basic ${Buffer.from(`${user}:wrong`).toString('base64')}` },
  });
  expect(wrong.status()).toBe(401);
  await anonymous.dispose();
});

test('Apache strips Basic credentials and forwards only the separate bearer header', async () => {
  const authenticated = await request.newContext({ baseURL, ignoreHTTPSErrors: true,
    extraHTTPHeaders: { Authorization: basic } });
  const noBearer = await authenticated.get('/__proxy_probe');
  expect(noBearer.status()).toBe(200);
  expect(await noBearer.json()).toMatchObject({
    authorization_scheme: '',
    probe_bearer_received: false,
    staging_header_present: false,
    forwarded_proto: 'https',
  });
  const withBearer = await authenticated.get('/__proxy_probe', {
    headers: { 'X-Staging-Api-Authorization': 'Bearer isolated-probe-token' },
  });
  expect(withBearer.status()).toBe(200);
  expect(await withBearer.json()).toMatchObject({
    authorization_scheme: 'Bearer',
    probe_bearer_received: true,
    staging_header_present: false,
  });
  await authenticated.dispose();
});

test('HTTP redirects to HTTPS and authenticated Laravel responses keep secure cookies', async ({ page }) => {
  const plain = await request.newContext({ ignoreHTTPSErrors: true });
  const redirect = await plain.get('http://localhost:18081/login?source=apache', { maxRedirects: 0 });
  expect(redirect.status()).toBe(302);
  expect(redirect.headers().location).toBe('https://localhost:18443/login?source=apache');
  await plain.dispose();

  const response = await page.goto('/login');
  expect(response?.status()).toBe(200);
  expect(page.url()).toMatch(/^https:\/\/localhost:18443\/login/);
  const cookieHeaders = response?.headersArray().filter(header => header.name.toLowerCase() === 'set-cookie') || [];
  expect(cookieHeaders.length).toBeGreaterThan(0);
  for (const cookie of cookieHeaders) {
    expect(cookie.value).toMatch(/;\s*Secure(?:;|$)/i);
    expect(cookie.value).toMatch(/;\s*SameSite=Lax(?:;|$)/i);
  }
  const csrf = await page.request.post('/logout');
  expect(csrf.status()).toBe(419);
});
