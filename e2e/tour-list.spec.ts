import { expect, test } from '@playwright/test';
import { stayLocal } from './helpers';

test('public tour list displays database results and empty search', async ({ page }) => {
  await stayLocal(page);
  await page.goto('/tour');
  await expect(page.getByRole('heading', { name: 'Explore tours' })).toBeVisible();
  await expect(page.getByRole('heading', { name: 'E2E Sample Tour', exact: true })).toBeVisible();
  await page.getByLabel('Search tours').fill('no-synthetic-tour-matches-this');
  await page.getByRole('button', { name: 'Search', exact: true }).click();
  await expect(page.getByRole('status')).toHaveText('No tours found. Try another search.');
});
