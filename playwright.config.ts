import { defineConfig, devices } from '@playwright/test';

export default defineConfig({
  testDir: './e2e',
  testIgnore: ['staging.spec.ts', 'apache-gate.spec.ts'],
  timeout: 45_000,
  expect: { timeout: 10_000 },
  fullyParallel: false,
  workers: 1,
  retries: process.env.CI ? 1 : 0,
  reporter: [['list'], ['html', { open: 'never' }]],
  outputDir: 'test-results',
  use: {
    ...devices['Desktop Chrome'],
    baseURL: 'http://127.0.0.1:8000',
    browserName: 'chromium',
    launchOptions: {
      executablePath: process.env.E2E_CHROMIUM_PATH || undefined,
    },
    screenshot: 'only-on-failure',
    trace: 'retain-on-failure',
  },
  webServer: {
    command: 'docker compose -f docker-compose.e2e.yml up app',
    url: 'http://127.0.0.1:8000/',
    reuseExistingServer: true,
    timeout: 120_000,
  },
});
