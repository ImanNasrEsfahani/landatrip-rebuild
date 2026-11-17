import { expect, request, test } from '@playwright/test';
import { execFileSync } from 'node:child_process';

const baseURL = process.env.STAGING_BASE_URL || 'https://localhost:18443';
const user = process.env.STAGING_ACCESS_USER || 'staging';
const password = process.env.STAGING_ACCESS_PASSWORD || '';
const basic = `Basic ${Buffer.from(`${user}:${password}`).toString('base64')}`;
const statusWithoutContext = (path: string, headers: string[] = []) => Number(execFileSync('curl', [
  '--noproxy', '*', '--silent', '--show-error', '--insecure', '--output', '/dev/null',
  '--write-out', '%{http_code}', ...headers.flatMap(header => ['--header', header]), `${baseURL}${path}`,
], { encoding: 'utf8' }));

test('Apache requires Basic credentials before reaching any upstream', async () => {
  expect(statusWithoutContext('/healthz')).toBe(401);
  expect(statusWithoutContext('/__proxy_probe')).toBe(401);
  expect(statusWithoutContext('/build/manifest.json')).toBe(401);
  expect(statusWithoutContext('/__proxy_probe', ['X-Staging-Api-Authorization: Bearer isolated-probe-token'])).toBe(401);
  expect(statusWithoutContext('/healthz', [`Authorization: Basic ${Buffer.from(`${user}:wrong`).toString('base64')}`])).toBe(401);
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

test('HTTP redirects to HTTPS with path and query preserved', async () => {
  const plain = await request.newContext({ ignoreHTTPSErrors: true });
  const redirect = await plain.get('http://localhost:18081/login?source=apache', { maxRedirects: 0 });
  expect(redirect.status()).toBe(302);
  expect(redirect.headers().location).toBe('https://localhost:18443/login?source=apache');
  await plain.dispose();
});

test('authenticated Laravel responses keep secure cookies and enforce CSRF', async ({ page }) => {
  const response = await page.goto('/login');
  expect(response?.status()).toBe(200);
  expect(page.url()).toMatch(/^https:\/\/localhost:18443\/login/);
  const cookieHeaders = (await response?.headersArray())?.filter(header => header.name.toLowerCase() === 'set-cookie') || [];
  expect(cookieHeaders.length).toBeGreaterThan(0);
  for (const cookie of cookieHeaders) {
    expect(cookie.value).toMatch(/;\s*Secure(?:;|$)/i);
    expect(cookie.value).toMatch(/;\s*SameSite=Lax(?:;|$)/i);
  }
  const csrf = await page.request.post('/logout');
  expect(csrf.status()).toBe(419);
});
