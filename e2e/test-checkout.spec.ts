import { expect, test, type APIRequestContext, type Page } from '@playwright/test';

const root = '/api/__e2e/checkout';
const json = { Accept: 'application/json' };

async function token(request: APIRequestContext, role: string) {
  const response = await request.post('/api/app/v1/login', {
    data: { email: `e2e-${role}@example.invalid`, password: process.env.E2E_TEST_PASSWORD },
    headers: json,
  });
  expect(response.status()).toBe(200);
  return { ...json, Authorization: `Bearer ${(await response.json()).token}` };
}

async function browserPost(page: Page, path: string, data: object, headers: Record<string, string>) {
  return page.evaluate(async ({ path, data, headers }) => {
    const response = await fetch(path, {
      method: 'POST', headers: { ...headers, 'Content-Type': 'application/json' },
      body: JSON.stringify(data),
    });
    return { status: response.status, body: await response.json() };
  }, { path, data, headers });
}

test('synthetic booking covers pricing, invoice snapshots, fake payment, expiry, and capacity', async ({ page, request }) => {
  await page.goto('/tour/e2e-sample-tour');
  await expect(page.getByText('E2E Sample Tour').first()).toBeVisible();
  const owner = await token(request, 'user');
  const other = await token(request, 'agent');
  const availability = await request.get('/api/booking/tour/e2e-sample-tour/group/e2e-sample-group');
  const group = (await availability.json()).data;
  const unpriced = await request.get('/api/booking/tour/e2e-sample-tour/group/e2e-unpriced-group');
  const emptyGroupId = (await unpriced.json()).data.id;
  const extra = group.price_items.find((item: { title: string }) => item.title === 'Synthetic optional extra');
  const usd = group.price_items.find((item: { title: string }) => item.title === 'Sample stored item');
  expect(extra).toBeTruthy();
  expect(usd).toBeTruthy();
  const adults = (count: number) => Array(count).fill('adult');
  const selection = { participants: adults(2), extras: [{ id: extra.id, quantity: 2 }] };

  const quote = await browserPost(page, `${root}/groups/${group.id}/quote`, selection, owner);
  expect(quote.status).toBe(200);
  expect(quote.body).toMatchObject({
    version: 'synthetic-cad-v1', currency: 'CAD', participants: 2,
    subtotal: '99.10', discount: '0.00', tax: '0.00', total: '99.10', gateway_minor_units: 9910,
  });
  expect(quote.body.lines).toHaveLength(2);
  expect((await request.post(`${root}/groups/${emptyGroupId}/quote`, {
    data: { participants: adults(1) }, headers: owner,
  })).status()).toBe(409);
  expect((await request.post(`${root}/groups/${group.id}/quote`, {
    data: { participants: ['child'] }, headers: owner,
  })).status()).toBe(422);
  expect((await request.post(`${root}/groups/${group.id}/quote`, {
    data: { participants: adults(1), extras: [{ id: usd.id, quantity: 1 }] }, headers: owner,
  })).status()).toBe(409);
  expect((await request.post(`${root}/groups/${group.id}/quote`, {
    data: { participants: adults(1), extras: [{ id: 999999, quantity: 1 }] }, headers: owner,
  })).status()).toBe(422);

  const create = (key: string, data: object) => request.post(`${root}/groups/${group.id}/invoices`, {
    data: { ...data, checkout_key: key }, headers: owner,
  });
  const first = await browserPost(page, `${root}/groups/${group.id}/invoices`,
    { ...selection, checkout_key: 'synthetic-first' }, owner);
  expect(first.status).toBe(201);
  const invoice = first.body;
  expect(invoice).toMatchObject({ group_id: group.id, status: 0, hold_status: 'active' });
  expect(invoice.details).toEqual([
    expect.objectContaining({ group_id: group.id, quantity: 2, unit_amount: '42.35', line_total: '84.70' }),
    expect.objectContaining({ group_id: group.id, quantity: 2, unit_amount: '7.20', line_total: '14.40' }),
  ]);
  expect((await create('synthetic-first', selection)).status()).toBe(201);
  expect((await create('synthetic-first', { participants: adults(1) })).status()).toBe(409);
  expect((await request.get(`${root}/invoices/${invoice.id}`, { headers: other })).status()).toBe(404);
  expect((await request.post(`${root}/invoices/${invoice.id}/initiate`, { headers: other })).status()).toBe(404);
  const initiation = await browserPost(page, `${root}/invoices/${invoice.id}/initiate`, {}, owner);
  expect(initiation.status).toBe(200);
  const authority = initiation.body.authority;
  expect((await (await request.post(`${root}/invoices/${invoice.id}/initiate`, { headers: owner })).json()).authority).toBe(authority);
  const callback = (result: 'success' | 'failure', id: string) => request.post(`${root}/callback`, {
    data: { authority: id, result }, headers: json,
  });
  expect((await browserPost(page, `${root}/callback`, { authority, result: 'success' }, json)).body)
    .toEqual({ status: 1, duplicate: false });
  expect(await (await callback('success', authority)).json()).toEqual({ status: 1, duplicate: true });
  expect((await (await request.get(`${root}/invoices/${invoice.id}`, { headers: owner })).json()).hold_status).toBe('booked');

  const failed = await create('synthetic-failed', { participants: adults(2) });
  expect(failed.status()).toBe(201);
  const failedId = (await failed.json()).id;
  const failedAuthority = (await (await request.post(`${root}/invoices/${failedId}/initiate`, { headers: owner })).json()).authority;
  expect(await (await callback('failure', failedAuthority)).json()).toEqual({ status: 2, duplicate: false });
  expect(await (await callback('success', failedAuthority)).json()).toEqual({ status: 2, duplicate: true });
  expect((await (await request.get(`${root}/invoices/${failedId}`, { headers: owner })).json()).hold_status).toBe('released');

  const expiring = await create('synthetic-expiring', { participants: adults(2) });
  expect(expiring.status()).toBe(201);
  const expiringId = (await expiring.json()).id;
  const expiringAuthority = (await (await request.post(`${root}/invoices/${expiringId}/initiate`, { headers: owner })).json()).authority;
  const expiry = await request.post(`${root}/invoices/${expiringId}/expire-for-test`, { headers: owner });
  expect((await expiry.json()).hold_status).toBe('expired');
  expect((await expiry.json()).status).toBe(3);
  expect((await request.post(`${root}/invoices/${expiringId}/initiate`, { headers: owner })).status()).toBe(409);
  expect(await (await callback('success', expiringAuthority)).json()).toEqual({ status: 3, duplicate: true });

  const simultaneous = await Promise.all([
    create('synthetic-capacity-a', { participants: adults(6) }),
    create('synthetic-capacity-b', { participants: adults(6) }),
  ]);
  expect(simultaneous.map(response => response.status()).sort()).toEqual([201, 409]);
  const winner = await simultaneous.find(response => response.status() === 201)!.json();
  expect((await request.post(`${root}/groups/${group.id}/invoices`, {
    data: { participants: adults(1), checkout_key: 'synthetic-overflow' }, headers: owner,
  })).status()).toBe(409);
  expect((await request.get(`${root}/invoices/${winner.id}`, { headers: owner })).status()).toBe(200);
});
