import { expect, test } from '@playwright/test';
import { login, roles, stayLocal } from './helpers';

for (const role of roles) {
  test(`${role} authenticates, renders its panel, and cannot view another panel`, async ({ page }) => {
    await stayLocal(page);
    const pageErrors: string[] = [];
    page.on('pageerror', error => pageErrors.push(error.message));
    await login(page, role);
    await expect(page).toHaveURL(new RegExp(`/${role}-panel(?:/|$)`));
    await expect(page.locator('#app')).not.toBeEmpty();
    await page.waitForTimeout(500);
    if (role === 'admin') {
      await expect(page.getByRole('heading', { name: 'Admin panel' })).toBeVisible();
      await page.getByRole('link', { name: 'Create ticket' }).click();
      await expect(page.getByText('Create a new ticket')).toBeVisible();
      await expect(page.locator('input[name="title"]')).toBeVisible();
      await expect(page.locator('textarea[name="message"]')).toBeVisible();
      await page.screenshot({ path: 'test-results/admin-ticket-form.png', fullPage: true });
      await page.goto('/admin-panel');
    }
    expect(pageErrors).toEqual([]);
    await page.screenshot({ path: `test-results/${role}-panel.png`, fullPage: true });
    await page.reload();
    await expect(page).toHaveURL(new RegExp(`/${role}-panel(?:/|$)`));
    await expect(page.locator('#app')).not.toBeEmpty();

    const other = role === 'admin' ? 'user' : 'admin';
    const apiLogin = await page.request.post('/api/app/v1/login', {
      data: { email: `e2e-${role}@example.invalid`, password: process.env.E2E_TEST_PASSWORD },
      headers: { Accept: 'application/json' },
    });
    expect(apiLogin.status()).toBe(200);
    const apiHeaders = { Accept: 'application/json', Authorization: `Bearer ${(await apiLogin.json()).token}` };
    const otherApi = await page.request.get(`/api/web/v1/${other}-panel/user-info`, {
      headers: apiHeaders,
    });
    expect(otherApi.status()).toBe(403);
    if (role === 'teacher') {
      const tours = await page.request.get('/api/web/v1/teacher-panel/tours', {
        headers: apiHeaders,
      });
      expect(tours.status()).toBe(200);
      expect((await tours.json()).data[0].title).toBe('E2E Sample Tour');
    }
    await page.goto(`/${other}-panel`);
    await expect(page).not.toHaveURL(new RegExp(`/${other}-panel(?:/|$)`));
    await page.evaluate(async () => {
      const csrf = document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')?.content;
      await fetch('/logout', { method: 'POST', headers: { 'X-CSRF-TOKEN': csrf || '' } });
    });
    await page.goto(`/${role}-panel`);
    await expect(page).toHaveURL(/\/login(?:\?|$)/);
  });
}
