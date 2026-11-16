# Staging deployment guide

## Local staging test

Requirements: Docker Engine with Compose, Node 22.12 or newer, npm, and enough disk for the PHP image, MySQL image, locked dependencies, and Chromium. Run:

```bash
git checkout feature/staging-e2e-testing
bash scripts/e2e-run.sh
```

The script generates temporary keys, starts the isolated app at `http://127.0.0.1:8000`, resets only `landatrip_e2e`, and runs Playwright. Use `E2E_CHROMIUM_PATH=/usr/bin/chromium` to use a system Chromium if Playwright's browser download is unavailable. `E2E_CA_BUNDLE=/path/to/trusted-ca.pem` is available for local Composer installations behind a TLS inspecting proxy.

Read `playwright-report/index.html` locally. Screenshots and failure traces are under `test-results/`. CI uploads these as a `playwright-results` artifact. To stop and discard the disposable database:

```bash
docker compose -f docker-compose.e2e.yml down -v
```

## Promotion checklist

1. Require green backend, frontend, and Chromium PR workflows.
2. Provision a separate nonproduction MySQL 8 database, HTTPS, queue, mail sandbox, file storage sandbox, and explicit provider test accounts. Never copy production users or credentials.
3. Configure `APP_ENV`, generated `APP_KEY`, database connection, `APP_URL`, session settings, and provider sandbox values through the hosting secret store.
4. Build from locked Composer and npm dependencies; run `php artisan migrate --force` on the staging database; verify `php artisan route:list`, assets, and health checks.
5. Test the unautomated workflows in `E2E_TEST_MATRIX.md` with sandbox integrations, including payment failure and duplicate callbacks.
6. Review the remaining issues in `KNOWN_ISSUES.md` before exposing any staging URL.

This guide does not provision cloud resources or change production infrastructure.
