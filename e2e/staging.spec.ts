import { expect, test } from '@playwright/test';

const roles = ['user', 'teacher', 'agent', 'manager', 'admin'] as const;

test('public pages, tour, assets, checkout gate and fixture isolation', async ({ page }) => {
  const errors: string[] = [];
  page.on('pageerror', error => errors.push(error.message));
  for (const path of ['/', '/tour', '/tour/staging-sample-tour']) {
    const response = await page.goto(path);
    expect(response?.status(), path).toBe(200);
    await expect(page.locator('body')).not.toBeEmpty();
  }
  const assets = await page.locator('script[src],link[rel="stylesheet"]').evaluateAll(elements =>
    elements.map(element => element.getAttribute('src') || element.getAttribute('href')).filter(Boolean) as string[]
  );
  expect(assets.length).toBeGreaterThan(0);
  for (const asset of assets.slice(0, 5)) {
    const url = new URL(asset, page.url());
    if (url.origin !== new URL(page.url()).origin) continue;
    const response = await page.request.get(url.toString());
    expect(response.ok(), asset).toBeTruthy();
  }
  const fixture = await page.request.post('/api/__e2e/checkout/callback', { data: {} });
  expect(fixture.status()).toBe(404);
  expect(errors).toEqual([]);
});

for (const role of roles) {
  test(`${role} signs in, stays in its panel, and signs out`, async ({ page }) => {
    const errors: string[] = [];
    page.on('pageerror', error => errors.push(error.message));
    const password = process.env[`STAGING_DEMO_PASSWORD_${role.toUpperCase()}`];
    if (!password) throw new Error(`Missing password for ${role}`);
    await page.goto('/login');
    await page.locator('#input-email').fill(`staging-${role}@example.invalid`);
    await page.locator('#input-pass').fill(password);
    await page.getByRole('button', { name: /log in/i }).click();
    await expect(page).toHaveURL(new RegExp(`/${role}-panel(?:/|$)`));
    await expect(page.locator('#app')).not.toBeEmpty();
    if (role === 'user') {
      const availability = await page.request.get('/api/booking/tour/staging-sample-tour/group/staging-sample-group');
      expect(availability.status()).toBe(200);
      const group = (await availability.json()).data;
      const checkout = await page.request.get(`/tour/staging-sample-tour/tour-operation/${group.id}/booking`);
      expect(checkout.status()).toBe(409);
    }
    const other = role === 'admin' ? 'user' : 'admin';
    const apiLogin = await page.request.post('/api/app/v1/login', {
      data: { email: `staging-${role}@example.invalid`, password },
      headers: { Accept: 'application/json' },
    });
    expect(apiLogin.status()).toBe(200);
    const token = (await apiLogin.json()).token;
    const denied = await page.request.get(`/api/web/v1/${other}-panel/user-info`, {
      headers: { Accept: 'application/json', 'X-Staging-Api-Authorization': `Bearer ${token}` },
    });
    expect(denied.status()).toBe(403);
    await page.evaluate(async () => {
      const csrf = document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content;
      await fetch('/logout', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf || '' } });
    });
    await page.goto(`/${role}-panel`);
    await expect(page).toHaveURL(/\/login(?:\?|$)/);
    expect(errors).toEqual([]);
  });
}
