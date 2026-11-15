# Laravel Modernization Plan

Last updated: 2026-11-15

## Goal and invariants

Move the application from Laravel 10 to Laravel 13 through separately verified Laravel 11 and Laravel 12 checkpoints. Preserve the legacy application structure and business behavior. Do not upgrade React, Vite, Tailwind, or MySQL.

Every checkpoint must preserve all routes and the mobile REST API v1, Sanctum tokens, booking/payment integrations, role-specific panels, the React UI, and existing schema/data structures.

## Baseline

- Repository: `ImanNasrEsfahani/landatrip-rebuild`
- Branch/commit at start: `work` / `a39bb498`
- Working tree at start: clean
- Installed framework: Laravel `v10.38.2`
- Installed Sanctum: `v3.3.2`
- Prepared runtime at start: PHP `8.2.35`, Composer `2.5.5`, Docker wrapper `/workspace/.cloud-setup/php`
- Database configuration: SQLite at `/workspace/.cloud-setup/development.sqlite`
- Previous onboarding evidence: Laravel 10 booted; SQLite migrations completed; Home and About returned HTTP 200; six selected tests passed.
- Known unrelated issue: the frontend has a case-sensitive `tour` / `Tour.tsx` import mismatch.

## Verification gate for each phase

1. Resolve dependencies on the real supported PHP platform without ignored platform requirements.
2. Validate `composer.json` and regenerate a consistent `composer.lock`.
3. Confirm `php artisan --version`, package discovery, and route enumeration.
4. Compare route and API-v1 inventories with the prior checkpoint.
5. Run focused Home/About, authentication/Sanctum, API-v1, and business-critical regression tests, then the viable suite.
6. Run all migrations against a new isolated SQLite file and inspect migration status.
7. Confirm Sanctum migration/config compatibility and token middleware registration.
8. Record exact versions, results, risks, and reproduction commands.
9. Commit the verified checkpoint without pushing.

## Phase A: Laravel 10 to 11

- Require PHP 8.2+ and Laravel `^11.0`.
- Upgrade Sanctum to `^4.0`, Collision to `^8.1`, Inertia Laravel to `^1.0`, and Livewire to a Laravel-11-compatible release.
- Publish/retain Sanctum migrations in the application because Sanctum 4 no longer auto-loads them.
- Update Sanctum middleware class references if the existing config uses renamed middleware.
- Keep the Laravel 10 application structure, as recommended by the official Laravel 11 guide.
- Audit custom authentication contract implementations, schema introspection, Carbon behavior, and package constraints.

## Phase B: Laravel 11 to 12

- Require Laravel `^12.0` and PHPUnit `^11.0`.
- Ensure Carbon 3 is installed and audit date-difference behavior where relevant.
- Audit custom password token repositories, manually constructed database grammar/blueprint objects, filesystem assumptions, and SVG image validation.
- Repeat the complete verification gate and commit only when it passes.

Status: verified on Laravel `v12.72.0`. The route inventory is unchanged from the Laravel 11 checkpoint, all 98 migrations pass on a fresh SQLite database, and the full 20-test suite passes.

## Phase C: Laravel 12 to 13

- Require Laravel `^13.0`, Tinker `^3.0`, and PHPUnit `^12.0`.
- Use PHP 8.4, which satisfies Laravel 13's `^8.3` requirement; install the application's HTTP extension stack from Debian's verified packages.
- Audit cache/session naming, cache unserialization configuration, nullable container defaults, MySQL/MariaDB `upsert` calls, and direct CSRF middleware references.
- Repeat the complete verification gate and commit only when it passes.

## Delivery

Prepare a PR-ready branch with the three checkpoint commits, exact dependency versions, verification results, remaining risks, PHP requirements, and reproducible setup/test commands. Do not push or merge automatically.

