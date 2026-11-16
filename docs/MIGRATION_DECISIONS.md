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

## D-009 — Upgrade only the Inertia server adapter

**Decision:** Upgrade `inertiajs/inertia-laravel` from 1.x to 2.x for Laravel 13, without changing any JavaScript dependencies.

**Reason:** Inertia Laravel 1.x supports Laravel only through version 12, while 2.x explicitly supports Laravel 13. This is a backend compatibility change and keeps the React/Vite/Tailwind scope frozen.

## D-010 — Adopt Laravel 13 cache hardening without ending sessions

**Decision:** Disable arbitrary cache object unserialization with `serializable_classes => false`, but explicitly retain PHP session serialization during this upgrade.

**Reason:** The application has no cache calls that store PHP objects, so the hardened cache default is safe. Changing session serialization to JSON would invalidate active sessions; retaining PHP preserves user-panel continuity and does not affect Sanctum personal access tokens.

## D-011 — Update CSRF references while retaining the legacy kernel

**Decision:** Make the existing application `VerifyCsrfToken` middleware extend Laravel 13's `PreventRequestForgery` class and point Sanctum at the same modern framework middleware.

**Reason:** Laravel 13 deprecates the framework `VerifyCsrfToken` and `ValidateCsrfToken` aliases. Keeping the application class name avoids restructuring the legacy kernel while enabling Laravel 13 request-origin protection.

## D-012 — Make MySQL 8 the backend CI verification database

**Decision:** Run the final CI gate on PHP 8.4 with a pinned `mysql:8.0` service, while retaining SQLite only as earlier checkpoint evidence.

**Reason:** The production-shaped database engine catches grammar, index, and schema behavior that SQLite cannot. The CI database uses isolated test-only credentials, runs all migrations from scratch, seeds only required language fixtures, and never contacts production services.

## D-013 — Assert stable routes and classify placeholders explicitly

**Decision:** Replace the broad logging-only route test with explicit status and authentication contracts for stable endpoints, while checking known placeholder routes only for registration.

**Reason:** A route sweep that always passes can conceal backend regressions. Conversely, asserting HTTP 200 for known incomplete routes would falsely certify them as functional.

