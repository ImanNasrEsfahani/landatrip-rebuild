# Laravel Migration Decisions

Last updated: 2026-11-15

## D-001 — Preserve the existing application structure

**Decision:** Keep the Laravel 10 bootstrap, providers, middleware, configuration, and directory structure throughout the upgrade unless a verified incompatibility requires a targeted change.

**Reason:** The official Laravel 11 upgrade guide explicitly advises upgraded Laravel 10 applications not to adopt the slim Laravel 11 application structure. This also minimizes risk to the route-heavy business application.

## D-002 — Use PHP 8.4 for dependency resolution and verification

**Decision:** Upgrade the prepared Docker runtime from PHP 8.2 to Debian 13's PHP 8.4 packages and use that same runtime for all three checkpoints.

**Reason:** Laravel 13 requires PHP `^8.3`. The direct PECL channel was unavailable, but Debian 13 provides PHP 8.4 and verified `php8.4-raphf` / `php8.4-http` packages. This satisfies Laravel 11–13 and PHPUnit 12 without weakening TLS or removing the application's explicit extension requirement.

## D-003 — Treat historical dependencies as reference-only

**Decision:** Do not copy packages from `old_vendor` or reuse `old_composer.lock` as a resolved checkpoint.

**Reason:** Both artifacts describe the Laravel 10 dependency graph. Composer must resolve each new major against the actual PHP platform and current package constraints.

## D-004 — Keep frontend upgrades out of scope

**Decision:** Do not change React, Vite, Tailwind, Node dependencies, or the known `tour` / `Tour.tsx` import mismatch during the Laravel migration.

**Reason:** The issue predates the backend modernization and is explicitly tracked as a separate frontend defect.

## D-005 — Use disposable SQLite databases for migration checks

**Decision:** Verify schema compatibility against new SQLite files under `/workspace/.cloud-setup/`; do not reset the configured development database.

**Reason:** This gives repeatable migration evidence without risking existing data or relying on production credentials.

## D-006 — Permit security-block bypass only for the Laravel 11 checkpoint

**Decision:** Use Composer 2.11's `--no-security-blocking` option only to resolve the required historical Laravel 11 checkpoint, then run `composer audit`, record its findings, and continue directly to Laravel 12 and 13.

**Reason:** Composer's current advisory database blocks every Laravel 11 release, making the explicitly required intermediate checkpoint otherwise unresolvable. TLS verification and PHP/extension platform requirements remain enforced. The Laravel 11 lock is a checkpoint artifact, not the final deliverable runtime.

## D-007 — Keep the customized Sanctum migration

**Decision:** Do not publish Sanctum 4's stock token migration because the application already owns `2019_12_14_000001_create_personal_access_tokens_table.php` with ULID morphs, a Firebase token column, abilities, and token expiry.

**Reason:** Publishing the stock migration would create a duplicate table and discard application-specific schema. The existing migration ran successfully with Sanctum 4 on isolated SQLite.

## D-008 — Upgrade Scout with the Laravel 12 checkpoint

**Decision:** Upgrade `laravel/scout` to 11.x and `matchish/laravel-scout-elasticsearch` to 7.14.x during Phase B.

**Reason:** Matchish 7.14 is the release line compatible with Laravel 12 and requires Scout 11. The resolved pair boots, preserves all registered search-related routes, and passes the full application suite.

