import { expect, test } from '@playwright/test';
import { login, stayLocal } from './helpers';

test('teacher uses Edit to revise and append itinerary days without removing omitted days', async ({ page }) => {
  await stayLocal(page);
  await login(page, 'teacher');
  await expect(page).toHaveURL(/\/teacher-panel/);
  const id = await page.evaluate(async () => {
    const headers = { 'Content-Type': 'application/json', Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest',
      'X-CSRF-TOKEN': document.querySelector<HTMLMetaElement>('meta[name="csrf-token"]')!.content };
    const cities = await (await fetch('/api/web/v1/teacher-panel/country/e2e-country', { headers })).json();
    const created = await fetch('/api/web/v1/teacher-panel/tours', { method: 'POST', headers, body: JSON.stringify({
      title: 'Synthetic editor fixture', subtitle: 'Synthetic subtitle', short_summary: 'Synthetic summary', tour_overview: 'Synthetic overview',
      location_id: cities.data[0].id, age: [20, 37], evaluation_type: 'noEvaluation',
      itineraries: [{ title: 'Arrival day', description: 'Synthetic arrival', start: 1, end: 1 },
        { title: 'Explore region', description: 'Synthetic exploration', start: 2, end: 2 }],
    }) });
    if (!created.ok) throw new Error(`Fixture creation failed ${created.status}`);
    const tours = await (await fetch('/api/web/v1/teacher-panel/tours', { headers })).json();
    return tours.data.find(tour => tour.title === 'Synthetic editor fixture').id;
  });
  await page.goto(`/teacher-panel/tours/${id}`);
  await page.getByRole('button', { name: 'Edit', exact: true }).click();
  const dialog = page.getByRole('dialog', { name: 'Edit tour' });
  await dialog.getByLabel('Tour name', { exact: true }).fill('Updated editor fixture');
  await dialog.getByLabel('Itinerary 1 title', { exact: true }).fill('Revised arrival');
  await dialog.getByRole('button', { name: 'Add itinerary day', exact: true }).click();
  await dialog.getByLabel('Itinerary 3 title', { exact: true }).fill('Final day');
  await dialog.getByLabel('Itinerary 3 description', { exact: true }).fill('Synthetic finale');
  const update = page.waitForResponse(response => response.request().method() === 'PUT' && new URL(response.url()).pathname.endsWith(`/tours/${id}`));
  await dialog.getByRole('button', { name: 'Save changes', exact: true }).click();
  expect((await update).status()).toBe(200);
  await expect(page.getByText('Tour updated.', { exact: true })).toBeVisible();
  const data = await page.evaluate(async tourId => (await (await fetch(`/api/web/v1/teacher-panel/tours/${tourId}/edit-data`, {
    headers: { Accept: 'application/json', 'X-Requested-With': 'XMLHttpRequest' },
  })).json()).data, id);
  expect(data.title).toBe('Updated editor fixture');
  expect(data.itineraries.map(day => day.title)).toEqual(['Revised arrival', 'Explore region', 'Final day']);
});
