import { expect, test } from '@playwright/test';
import { login, stayLocal } from './helpers';

test.beforeEach(async ({ page }) => stayLocal(page));

async function waitForPublicPaint(page: import('@playwright/test').Page) {
  await expect.poll(async () => page.locator('#body').evaluate(element => Number(getComputedStyle(element).opacity)))
    .toBeGreaterThan(0.95);
}

test('home, about, tour listing, and history render', async ({ page }) => {
  const failures: string[] = [];
  page.on('pageerror', error => failures.push(error.message));
  page.on('response', response => {
    if (response.url().startsWith('http://127.0.0.1:8000/') && response.status() >= 400 &&
        ['image', 'font', 'stylesheet', 'script'].includes(response.request().resourceType())) {
      failures.push(`${response.status()} ${response.url()}`);
    }
  });
  for (const [path, title] of [
    ['/', /Landa Trip/i],
    ['/about-us', /Landa Trip/i],
    ['/tour', /Landa Trip/i],
  ] as const) {
    const response = await page.goto(path);
    expect(response?.status(), path).toBe(200);
    await expect(page).toHaveTitle(title);
    await expect(page.locator('body')).not.toBeEmpty();
    await waitForPublicPaint(page);
    if (path === '/') await page.screenshot({ path: 'test-results/home-desktop.png', fullPage: true });
  }
  await page.goBack();
  await expect(page).toHaveURL(/\/about-us$/);
  await page.locator('a[href$="/contact-us"]:visible').first().click();
  await expect(page).toHaveURL(/\/contact-us$/);
  expect(failures).toEqual([]);
});

test('seeded tour detail and public assets load', async ({ page }) => {
  const response = await page.goto('/tour/e2e-sample-tour');
  expect(response?.status()).toBe(200);
  await expect(page.getByText('E2E Sample Tour').first()).toBeVisible();
  await waitForPublicPaint(page);
  await page.screenshot({ path: 'test-results/tour-detail.png', fullPage: true });
  const assets = await page.locator('script[src],link[rel="stylesheet"]').evaluateAll(elements =>
    elements.map(element => (element as HTMLScriptElement | HTMLLinkElement).getAttribute('src') || (element as HTMLLinkElement).getAttribute('href'))
      .filter(Boolean) as string[]
  );
  expect(assets.length).toBeGreaterThan(0);
  for (const asset of assets.filter(asset => new URL(asset, page.url()).hostname === '127.0.0.1').slice(0, 5)) {
    const result = await page.request.get(new URL(asset, page.url()).toString());
    expect(result.ok(), asset).toBeTruthy();
  }
  const availability = await page.request.get('/api/booking/tour/e2e-sample-tour/group/e2e-sample-group', {
    headers: { Accept: 'application/json' },
  });
  expect(availability.status()).toBe(200);
  expect((await availability.json()).data.capacity).toBe(8);
});

test('booking step one loads the seeded tour and group', async ({ page }) => {
  const errors: string[] = [];
  page.on('pageerror', error => errors.push(error.message));
  await login(page, 'user');
  const response = await page.goto('/tour/e2e-sample-tour/group/e2e-sample-group/step1');
  expect(response?.status()).toBe(200);
  await expect(page.locator('#booking-tour')).toHaveAttribute('tour_slug', 'e2e-sample-tour');
  await expect(page.locator('#booking-tour')).toHaveAttribute('group_slug', 'e2e-sample-group');
  await expect(page.getByText('Trip info')).toBeVisible();
  await expect(page.getByText('E2E Sample Tour', { exact: true })).toBeVisible();
  await waitForPublicPaint(page);
  await page.screenshot({ path: 'test-results/booking-step1.png', fullPage: true });
  expect(errors).toEqual([]);
});

test('stored group price is shown without an invented invoice or gateway charge', async ({ page }) => {
  await login(page, 'user');
  const availability = await page.request.get('/api/booking/tour/e2e-sample-tour/group/e2e-sample-group');
  expect(availability.status()).toBe(200);
  const group = (await availability.json()).data;
  expect(group.registration_open).toBe(true);
  expect(group.price_items).toEqual([expect.objectContaining({ title: 'Sample stored item', amount: 125, currency: 'USD' })]);

  await page.goto('/tour/e2e-sample-tour/group/e2e-sample-group/step1');
  await expect(page.locator('p:visible').filter({ hasText: 'Sample stored item' }).first()).toBeVisible();
  await expect(page.locator('p:visible').filter({ hasText: /payable total is unavailable/i }).first()).toBeVisible();

  const apiLogin = await page.request.post('/api/app/v1/login', {
    data: { email: 'e2e-user@example.invalid', password: process.env.E2E_TEST_PASSWORD },
    headers: { Accept: 'application/json' },
  });
  expect(apiLogin.status()).toBe(200);
  const headers = { Accept: 'application/json', Authorization: `Bearer ${(await apiLogin.json()).token}` };
  const invoiceBefore = await page.request.get('/api/web/v1/user-panel/invoices', { headers });
  expect(invoiceBefore.status()).toBe(200);
  const attempt = await page.request.get(`/tour/e2e-sample-tour/tour-operation/${group.id}/booking`);
  expect(attempt.status()).toBe(409);
  const invoiceAfter = await page.request.get('/api/web/v1/user-panel/invoices', { headers });
  expect(invoiceAfter.status()).toBe(200);
  expect((await invoiceAfter.json()).data).toEqual((await invoiceBefore.json()).data);
});

test('mobile layout and contact form render', async ({ page }) => {
  await page.setViewportSize({ width: 390, height: 844 });
  const response = await page.goto('/contact-us');
  expect(response?.status()).toBe(200);
  await expect(page.locator('form').first()).toBeVisible();
  await waitForPublicPaint(page);
  await page.screenshot({ path: 'test-results/contact-mobile.png', fullPage: true });
});
