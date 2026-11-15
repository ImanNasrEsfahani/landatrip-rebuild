# LandaTrip Modernization Instructions

## Scope

Upgrade Laravel incrementally through verified Laravel 11, 12, and 13 checkpoints. Preserve the existing Laravel 10 application structure and all business functionality, routes, mobile API v1 endpoints, Sanctum authentication, panels, integrations, database structures, and React UI.

## Runtime and commands

- Run PHP and Composer through `/workspace/.cloud-setup/php`, explicitly passing the executable, for example: `/workspace/.cloud-setup/php php artisan --version` and `/workspace/.cloud-setup/php composer install`.
- The wrapper mounts `/workspace`, uses the prepared `landatrip-php` image, reuses `/workspace/.cloud-setup/composer-cache`, and keeps TLS verification enabled with the prepared CA bundle.
- Use isolated SQLite files under `/workspace/.cloud-setup/` for migration verification. Never run destructive migration commands against a configured non-test database.
- Do not use `old_vendor` or `old_composer.lock` as dependencies for a new checkpoint. They are reference artifacts only.

## Checkpoint policy

- Do not begin a new Laravel major until the current one resolves dependencies, boots, registers routes, passes the selected regression suite, validates Sanctum/mobile API behavior, and migrates a fresh isolated SQLite database.
- Update `docs/MIGRATION_STATUS.md` with exact versions, evidence, blockers, and the next command whenever work pauses.
- Record non-obvious compatibility choices in `docs/MIGRATION_DECISIONS.md`.
- Create one meaningful commit per verified Laravel major. Do not push or merge.

## Out of scope

- Do not upgrade React, Vite, Tailwind, or MySQL.
- The existing case-sensitive frontend import mismatch (`tour` versus `Tour.tsx`) is not a Laravel regression.

