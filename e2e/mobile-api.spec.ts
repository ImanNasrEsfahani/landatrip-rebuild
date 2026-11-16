import { expect, test } from '@playwright/test';

test('mobile API v1 rejects anonymous requests and accepts a temporary Sanctum token', async ({ request }) => {
  const anonymous = await request.get('/api/app/v1/user', { headers: { Accept: 'application/json' } });
  expect(anonymous.status()).toBe(401);

  const password = process.env.E2E_TEST_PASSWORD;
  if (!password) throw new Error('E2E_TEST_PASSWORD must be set');
  const login = await request.post('/api/app/v1/login', {
    data: { email: 'e2e-user@example.invalid', password },
    headers: { Accept: 'application/json' },
  });
  expect(login.status()).toBe(200);
  const { token } = await login.json();
  expect(token).toEqual(expect.any(String));

  const profile = await request.get('/api/app/v1/user', {
    headers: { Authorization: `Bearer ${token}`, Accept: 'application/json' },
  });
  expect(profile.status()).toBe(200);
  expect((await profile.json()).data.slug).toBe('e2e-user');

  const logout = await request.post('/api/app/v1/logout', {
    headers: { Authorization: `Bearer ${token}`, Accept: 'application/json' },
  });
  expect(logout.status()).toBe(200);
  const expired = await request.get('/api/app/v1/user', {
    headers: { Authorization: `Bearer ${token}`, Accept: 'application/json' },
  });
  expect(expired.status()).toBe(401);
});
