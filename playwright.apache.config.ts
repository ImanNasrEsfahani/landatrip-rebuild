import { defineConfig } from '@playwright/test';
import staging from './playwright.staging.config';

export default defineConfig({
  ...staging,
  testMatch: ['staging.spec.ts', 'apache-gate.spec.ts'],
  projects: staging.projects?.filter(project => project.name === 'chromium-desktop'),
});
