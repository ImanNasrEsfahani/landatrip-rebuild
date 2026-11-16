import { defineConfig, devices } from '@playwright/test';

const baseURL = process.env.STAGING_BASE_URL || 'https://localhost:8443';
const username = process.env.STAGING_ACCESS_USER || 'staging';
const password = process.env.STAGING_ACCESS_PASSWORD;
if (!password) throw new Error('STAGING_ACCESS_PASSWORD is required');

export default defineConfig({
  testDir: './e2e',
  testMatch: 'staging.spec.ts',
  timeout: 45_000,
  fullyParallel: false,
  workers: 1,
  reporter: [['list'], ['html', { open: 'never' }]],
  projects: [
    { name: 'chromium-desktop', use: { ...devices['Desktop Chrome'] } },
    { name: 'chromium-mobile', use: { ...devices['Pixel 7'] } },
  ],
  use: {
    baseURL,
    browserName: 'chromium',
    launchOptions: { executablePath: process.env.E2E_CHROMIUM_PATH || undefined },
    ignoreHTTPSErrors: baseURL.startsWith('https://localhost'),
    httpCredentials: { username, password },
    screenshot: 'only-on-failure',
    trace: 'retain-on-failure',
  },
});
