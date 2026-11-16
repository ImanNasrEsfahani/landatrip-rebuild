import type { Page } from '@playwright/test';

export const roles = ['user', 'teacher', 'agent', 'manager', 'admin'] as const;

export async function stayLocal(page: Page) {
  await page.route('**/*', route => {
    const url = new URL(route.request().url());
    if (url.hostname === '127.0.0.1' || url.hostname === 'localhost' || url.protocol === 'data:') {
      return route.continue();
    }
    return route.abort();
  });
}

export async function login(page: Page, role: typeof roles[number]) {
  const password = process.env.E2E_TEST_PASSWORD;
  if (!password) throw new Error('E2E_TEST_PASSWORD must be set');
  await page.goto('/login');
  await page.locator('#input-email').fill(`e2e-${role}@example.invalid`);
  await page.locator('#input-pass').fill(password);
  await page.getByRole('button', { name: /log in/i }).click();
}
