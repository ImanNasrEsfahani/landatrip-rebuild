# Staging readiness

## Reproducible local stack

`docker-compose.e2e.yml` defines a separate `landatrip-e2e` Compose project. It uses PHP 8.4 from `docker/e2e/Dockerfile`, a tmpfs backed MySQL 8.0 service, and local port 8000. Node 22 runs the pinned npm lockfile and Playwright. The Compose project does not touch the existing Sail stack or production infrastructure. The test database is named `landatrip_e2e`; the fixture seeder refuses any other name.

Run `bash scripts/e2e-run.sh` from a checkout with Docker, Docker Compose, and Node 22. The script installs pinned Composer and npm dependencies, builds Vite assets, migrates the disposable database, seeds five synthetic users and one tour/group, creates the local storage link, starts the app, and runs Chromium. It generates a fresh app key and browser password in process memory. The local app remains on `http://127.0.0.1:8000` after the suite. `docker compose -f docker-compose.e2e.yml down -v` removes only this isolated stack.

The app uses array mail/cache, local files, synchronous queue, and null Scout. E2E browser requests to nonlocal hosts are aborted. No payment, SMS, flight, GCS, or customer notification flow is exercised. The committed `.env.testing.example` contains no live credentials. The test setup never copies customer data.

## Readiness gates

| Gate | Evidence |
| --- | --- |
| Laravel 13 / PHP 8.4 / MySQL 8 | Docker image uses PHP 8.4.27 and MySQL 8.0.46; all 98 migrations passed on the disposable database. |
| Frontend build | `npm run test:frontend` passed locally with Vite 7.3.8. |
| Browser | See `E2E_EXECUTION_REPORT.md` for the latest Chromium result. |
| Existing backend CI | See `E2E_EXECUTION_REPORT.md`; PR CI must also pass before merge. |
| External integrations | Require separate sandbox verification; see `KNOWN_ISSUES.md`. |

Staging is a local test environment at present. No public URL, DNS, paid resource, or production deployment has been created.
