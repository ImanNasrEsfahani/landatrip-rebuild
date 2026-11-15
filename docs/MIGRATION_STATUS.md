# Laravel Migration Status

Last updated: 2026-11-15

## Current checkpoint

Phase B (Laravel 12) — verified and ready for its checkpoint commit. Phase A is committed as `fb9c9e45`.

## Verified current state

| Item | State |
| --- | --- |
| Git branch / start commit | `work` / `a39bb498` |
| Start working tree | Clean |
| Laravel | `v12.72.0` from current `composer.lock` |
| Sanctum | `v4.4.0` |
| Fortify | `v1.42.0` |
| Scout | `v11.10.0` |
| Initial PHP runtime | `8.2.35` through `/workspace/.cloud-setup/php` |
| Initial Composer | `2.5.5` |
| Dependency cache | `/workspace/.cloud-setup/composer-cache` present and reused |
| Current lock consistency | Passes `composer validate` after Phase B resolution |
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
- Committed the verified Laravel 11 checkpoint as `fb9c9e45`.
- Resolved Laravel 12 without disabling Composer security blocking. Composer reported no known vulnerability advisories.
- Upgraded Scout to 11.10.0 and Matchish Elasticsearch integration to 7.14.3 to satisfy their Laravel 12 compatibility constraints.
- Audited the Laravel 12 guide's application-impact areas. The application has no custom password-token repository, manually constructed Blueprint/grammar, or affected SVG image rule. Its two Carbon `diffInDays` call sites do not depend on fractional results.
- Preserved the Laravel 11 route inventory exactly on Laravel 12: 342 total, 207 API, and 49 mobile API v1 routes.
- Ran all 98 migrations successfully against `/workspace/.cloud-setup/laravel12.sqlite`.
- Passed the Laravel 12 smoke set (6 tests, 6 assertions), Sanctum/mobile API regression set (2 tests, 8 assertions), and complete suite (20 tests, 26 assertions) on isolated database copies.
- Updated `phpunit.xml` to PHPUnit 11's current `source` schema; the configuration warning is resolved.

## Phase B exact versions

| Package | Version |
| --- | --- |
| PHP | 8.4.27 |
| Composer | 2.11.2 |
| laravel/framework | v12.72.0 |
| laravel/sanctum | v4.4.0 |
| laravel/fortify | v1.42.0 |
| laravel/scout | v11.10.0 |
| laravel/tinker | v2.11.1 |
| inertiajs/inertia-laravel | v1.3.4 |
| livewire/livewire | v3.8.11 |
| matchish/laravel-scout-elasticsearch | v7.14.3 |
| spatie/laravel-google-cloud-storage | 2.4.1 |
| spatie/laravel-medialibrary | 11.23.13 |
| nunomaduro/collision | v8.9.6 |
| phpunit/phpunit | 11.5.58 |

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

## Known risks

- Composer 2.11 security blocking had to be bypassed for dependency resolution because the historical Laravel 11 line is covered by advisories. Composer reported five advisories affecting Laravel after installation. This exception applies only to the temporary Laravel 11 checkpoint; proceed directly to newer supported majors.
- `phpunit.xml` sets `APP_ENV=production`, while the application's `HttpsProtocol` middleware redirects every non-`local` request. HTTP tests therefore require `APP_ENV=local` to exercise page content rather than the HTTPS redirect.
- The existing `AllRoutesTest` logs but does not assert route response failures. It reports pre-existing 404/500 responses for some Laratrust, placeholder, blog, and mailable routes.
- External booking/payment providers were not contacted; route registration and package compatibility are verified without production credentials.
- Composer reports `amadeus4dev/amadeus-php` as abandoned with no suggested replacement. It remains installed to preserve the existing flight integration.
- Composer reports pre-existing PSR-4 path/namespace mismatches in backup seeders and several request/resource/controller classes. Package discovery succeeds, but those classes need a separate compatibility review if exercised.

## Outstanding verification

- Commit the verified Laravel 12 checkpoint.
- Repeat the complete verification gate for Laravel 13.

## Exact next action

Create the Laravel 12 checkpoint commit, then update Composer constraints for Laravel 13, Tinker 3, and PHPUnit 12.

