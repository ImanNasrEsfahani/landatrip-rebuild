# Laravel Migration Status

Last updated: 2026-11-15

## Current checkpoint

Phase A (Laravel 11) — verified and ready for its checkpoint commit.

## Verified current state

| Item | State |
| --- | --- |
| Git branch / start commit | `work` / `a39bb498` |
| Start working tree | Clean |
| Laravel | `v10.38.2` from current `composer.lock` |
| Sanctum | `v3.3.2` |
| Fortify | `v1.19.1` |
| Scout | `v10.6.1` |
| Initial PHP runtime | `8.2.35` through `/workspace/.cloud-setup/php` |
| Initial Composer | `2.5.5` |
| Dependency cache | `/workspace/.cloud-setup/composer-cache` present and reused |
| Current lock consistency | Passes `composer validate` after Phase A resolution |
| Database target | SQLite `/workspace/.cloud-setup/development.sqlite` |
| Existing `vendor` | Present; Laravel 10 dependencies only |
| Reference artifacts | `old_vendor` and `old_composer.lock`; not trusted for upgrades |

## Completed work

- Inspected Git state, runtime wrapper, Docker image, manifests, both vendor trees, dependency cache, tests, and database configuration.
- Retrieved and reviewed the official Laravel 11, 12, and 13 upgrade guides.
- Confirmed the legacy Laravel 10 structure should be preserved for Laravel 11.
- Verified Laravel 13 requires PHP `^8.3`. Direct PECL access was unavailable, so selected Debian 13's PHP 8.4 packages, including packaged `php8.4-http` and `php8.4-raphf`.
- Created persistent modernization documentation.
- Built and validated the prepared PHP 8.4.27 / Composer 2.11.2 image with `ext-http` 4.2.6 and all required extensions.
- Resolved and installed Laravel 11.57.1, Sanctum 4.4.0, Fortify 1.42.0, Scout 10.25.0, and compatible application packages.
- Updated Sanctum's middleware map for Sanctum 4 while retaining the application's customized `personal_access_tokens` migration.
- Preserved the complete application route inventory: 341 baseline routes remain; Livewire adds one package source-map route. API remains 207 routes and mobile v1 remains 49 routes.
- Ran all 98 application migrations successfully against isolated SQLite file `/workspace/.cloud-setup/laravel11.sqlite`.
- Added and passed mobile API v1 / Sanctum token regression coverage: 2 tests, 8 assertions.
- Passed the onboarding smoke set: 6 tests, 6 assertions, using an isolated copy of the onboarding SQLite fixture.
- Passed the complete current suite: 20 tests, 26 assertions. The pre-existing `AllRoutesTest` only logs (and does not fail on) several 4xx/5xx responses, so this is not evidence that every business route is functionally healthy.
- Fixed `NewsletterEventTest` so it initializes the mail fake and dispatches the event it asserts.
- Passed Composer's non-dev platform-requirement check.

## Phase A exact versions

| Package | Version |
| --- | --- |
| PHP | 8.4.27 |
| Composer | 2.11.2 |
| laravel/framework | v11.57.1 |
| laravel/sanctum | v4.4.0 |
| laravel/fortify | v1.42.0 |
| laravel/scout | v10.25.0 |
| laravel/tinker | v2.11.1 |
| inertiajs/inertia-laravel | v1.3.4 |
| livewire/livewire | v3.8.11 |
| matchish/laravel-scout-elasticsearch | v7.13.0 |
| santigarcor/laratrust | 8.5.6 |
| shetabit/payment | v6.4.0 |
| spatie/laravel-medialibrary | 11.23.9 |
| phpunit/phpunit | 10.5.67 |

## Known Phase A risks

- Composer 2.11 security blocking had to be bypassed for dependency resolution because the historical Laravel 11 line is covered by advisories. Composer reported five advisories affecting Laravel after installation. This exception applies only to the temporary Laravel 11 checkpoint; proceed directly to newer supported majors.
- `phpunit.xml` sets `APP_ENV=production`, while the application's `HttpsProtocol` middleware redirects every non-`local` request. HTTP tests therefore require `APP_ENV=local` to exercise page content rather than the HTTPS redirect.
- The existing `AllRoutesTest` logs but does not assert route response failures. It reports pre-existing 404/500 responses for some Laratrust, placeholder, blog, and mailable routes.
- External booking/payment providers were not contacted; route registration and package compatibility are verified without production credentials.

## Outstanding verification

- Commit the verified Laravel 11 checkpoint.
- Repeat for Laravel 12 and Laravel 13.

## Exact next action

Create the Laravel 11 checkpoint commit, then update Composer constraints for Laravel 12 and PHPUnit 11.

