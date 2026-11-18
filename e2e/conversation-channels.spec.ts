import { expect, test } from '@playwright/test';
import { login, stayLocal } from './helpers';

test('conversation view subscribes only to active channels and leaves them on navigation', async ({ page }) => {
  const chatA = 'fixture-chat-a';
  const chatB = 'fixture-chat-b';
  const listEndpoint = '/api/web/v1/user-panel/conversation';
  await stayLocal(page);
  await page.routeWebSocket(/pusher\.com/, socket => socket.close());
  await page.addInitScript(() => {
    const events: string[] = [];
    Object.defineProperty(window, 'conversationChannelEvents', { value: events });
    const echo = {
      private(name: string) {
        return { listen: (event: string) => { events.push(`listen:${name}:${event}`); } };
      },
      leave(name: string) {
        events.push(`leave:${name}`);
      },
    };
    Object.defineProperty(window, 'Echo', { get: () => echo, set: () => {} });
  });
  await page.route(`**${listEndpoint}**`, async route => {
    const pathname = new URL(route.request().url()).pathname;
    if (pathname === listEndpoint) {
      await route.fulfill({ json: { data: [
        { communication_id: chatA, assign_name: 'Fixture Alpha', role: 'user', time: 'now' },
        { communication_id: chatB, assign_name: 'Fixture Beta', role: 'user', time: 'now' },
      ] } });
    } else {
      await route.fulfill({ json: {
        communication_id: pathname.split('/').at(-1), name: 'Fixture contact', role: 'user', data: [],
      } });
    }
  });

  await login(page, 'user');
  await expect(page).toHaveURL(/\/user-panel(?:\/|$)/);
  const userInfo = page.waitForResponse(response =>
    new URL(response.url()).pathname === '/api/web/v1/user-panel/user-info' && response.ok());
  await page.reload();
  const { data } = await (await userInfo).json();
  await page.goto('/user-panel/conversation');
  const listChannel = `list-channel.${data.user_id}`;
  const events = () => page.evaluate(() =>
    (window as Window & { conversationChannelEvents?: string[] }).conversationChannelEvents ?? []);
  await expect.poll(events).toContain(`listen:${listChannel}:ListEvent`);

  await page.getByRole('button', { name: /Fixture Alpha/ }).click();
  await expect.poll(events).toContain(`listen:chat.${chatA}:MessageEvent`);
  await page.getByRole('button', { name: /Fixture Beta/ }).click();
  await expect.poll(events).toContain(`leave:chat.${chatA}`);
  await expect.poll(events).toContain(`listen:chat.${chatB}:MessageEvent`);

  await page.getByRole('link', { name: 'Dashboard', exact: true }).click();
  await expect.poll(events).toContain(`leave:chat.${chatB}`);
  await expect.poll(events).toContain(`leave:${listChannel}`);
  expect(await events()).not.toContain('listen:list-channel:ListEvent');
});
