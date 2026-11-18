import { expect, test } from '@playwright/test';
import { login, stayLocal } from './helpers';

test('teacher submits two itinerary days through the active creation form', async ({ page }) => {
  await stayLocal(page);
  await login(page, 'teacher');
  await expect(page).toHaveURL(/\/teacher-panel/);
  await page.goto('/teacher-panel/tours/add-tour');
  await page.getByLabel('Tour Name', { exact: true }).fill('Synthetic browser tour');
  await page.getByLabel('Subtitle', { exact: true }).fill('Synthetic subtitle');
  await page.getByLabel('Tour Overview', { exact: true }).fill('Synthetic overview');
  await page.getByLabel('Describe Your Tour', { exact: true }).fill('Synthetic summary');
  await page.getByRole('combobox', { name: 'Country', exact: true }).click();
  await page.getByRole('option', { name: /E2E Country/ }).click();
  await page.getByRole('combobox', { name: 'City', exact: true }).click();
  await page.getByRole('option', { name: 'E2E City', exact: true }).click();
  await page.getByRole('button', { name: 'Day 1', exact: true }).click();
  await page.getByLabel('Day Title', { exact: true }).first().fill('Arrival day');
  await page.getByLabel('Day description', { exact: true }).first().fill('Synthetic arrival');
  await page.getByRole('button', { name: 'Add itinerary days', exact: true }).click();
  await page.getByRole('dialog').getByRole('button', { name: 'Add', exact: true }).click();
  await page.getByRole('button', { name: 'Day 2', exact: true }).click();
  await page.getByLabel('Day Title', { exact: true }).nth(1).fill('Explore region');
  await page.getByLabel('Day description', { exact: true }).nth(1).fill('Synthetic exploration');
  const saved = page.waitForResponse(response => response.request().method() === 'POST' &&
    new URL(response.url()).pathname === '/api/web/v1/teacher-panel/tours');
  await page.getByRole('button', { name: 'Save tour', exact: true }).click();
  const response = await saved;
  expect(response.status()).toBe(200);
  expect(await response.text()).toBe('1');
  expect(response.request().postDataJSON().itineraries.map(day => day.title)).toEqual(['Arrival day', 'Explore region']);
});
