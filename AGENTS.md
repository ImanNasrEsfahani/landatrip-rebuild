# LandaTrip Modernization Instructions

## Current staging and E2E scope

- Laravel PR #1 and frontend PR #2 are merged into `main`. Phase 3 work lives on `feature/staging-e2e-testing`.
- Use `bash scripts/e2e-run.sh` for a disposable MySQL 8 database, PHP 8.4, locked dependencies, built assets, and Chromium tests. It generates temporary credentials in process memory and leaves the isolated application on `http://127.0.0.1:8000`.
- `E2eSeeder` rejects databases other than `landatrip_e2e`. Never seed customer data or call payment, booking, SMS, email, or other production providers from E2E tests.
- See `docs/STAGING_READINESS.md`, `docs/E2E_TEST_MATRIX.md`, `docs/E2E_EXECUTION_REPORT.md`, `docs/KNOWN_ISSUES.md`, and `docs/STAGING_DEPLOYMENT_GUIDE.md` for the current evidence and remaining work.
- Do not merge the staging PR automatically.

## Historical frontend scope

- The Laravel 13 migration is complete and merged at `01af613`; keep PHP, Laravel, and database versions unchanged.
- Frontend modernization was merged through PR #2; preserve every route, layout, form, API contract, stylesheet, and application panel.
- Use the committed `package-lock.json`, plain `npm ci`, and `npm run test:frontend` for reproducible verification.
- Do not merge the frontend pull request automatically.

## Scope

Upgrade Laravel incrementally through verified Laravel 11, 12, and 13 checkpoints. Preserve the existing Laravel 10 application structure and all business functionality, routes, mobile API v1 endpoints, Sanctum authentication, panels, integrations, database structures, and React UI.

## Runtime and commands

- Run PHP and Composer through `/workspace/.cloud-setup/php`, explicitly passing the executable, for example: `/workspace/.cloud-setup/php php artisan --version` and `/workspace/.cloud-setup/php composer install`.
- The wrapper mounts `/workspace`, uses the prepared `landatrip-php` image, reuses `/workspace/.cloud-setup/composer-cache`, and keeps TLS verification enabled with the prepared CA bundle.
- Use isolated SQLite files under `/workspace/.cloud-setup/` for migration verification. Never run destructive migration commands against a configured non-test database.
- Do not restore `old_vendor` or `old_composer.lock` from Git history as dependencies for a new checkpoint. They describe the retired Laravel 10 dependency graph.

## Checkpoint policy

- Do not begin a new Laravel major until the current one resolves dependencies, boots, registers routes, passes the selected regression suite, validates Sanctum/mobile API behavior, and migrates a fresh isolated SQLite database.
- Update `docs/MIGRATION_STATUS.md` with exact versions, evidence, blockers, and the next command whenever work pauses.
- Record non-obvious compatibility choices in `docs/MIGRATION_DECISIONS.md`.
- Create one meaningful commit per verified Laravel major. Do not push or merge.

## Verified result

- Laravel 11 checkpoint: `fb9c9e45`.
- Laravel 12 checkpoint: `6801dd68`.
- Laravel 13 is verified on PHP 8.4.27 with 342 routes, 98 successful migrations, and 20 passing tests. See `docs/MIGRATION_STATUS.md` for exact versions and remaining staging checks.

## Historical Laravel migration scope

- React and Vite changes were intentionally excluded from the completed Laravel migration. They are now handled separately on the frontend modernization branch.
- Tailwind and MySQL major upgrades remain out of scope.
- The case-sensitive frontend import mismatch (`tour` versus `Tour.tsx`) was pre-existing and was fixed as the frontend baseline, not classified as a Laravel regression.

