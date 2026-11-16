# Laravel Migration Status

Last updated: 2026-11-16

## Current checkpoint

Phase C (Laravel 13) — verified and committed as `63fef424`. Phase A is committed as `fb9c9e45`; Phase B is committed as `6801dd68`.

## Verified current state

| Item | State |
| --- | --- |
| Delivery branch / start commit | `feature/laravel-13-modernization` / `a39bb498` |
| Pull request | Open against `main`: `https://github.com/ImanNasrEsfahani/landatrip-rebuild/pull/1` |
| Start working tree | Clean |
| Laravel | `v13.42.0` from current `composer.lock` |
| Sanctum | `v4.4.0` |
| Fortify | `v1.42.0` |
| Scout | `v11.10.0` |
| Initial PHP runtime | `8.2.35` through `/workspace/.cloud-setup/php` |
| Initial Composer | `2.5.5` |
| Dependency cache | `/workspace/.cloud-setup/composer-cache` present and reused |
| Current lock consistency | Passes `composer validate` after Phase C resolution; Composer reports no known advisories |
| Database target | SQLite `/workspace/.cloud-setup/development.sqlite` |
| Installed `vendor` | Present and synchronized with the Laravel 13 lock |
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
- Committed the verified Laravel 12 checkpoint as `6801dd68`.
- Resolved Laravel 13.42.0, Tinker 3.1.0, and PHPUnit 12.5.44 without bypassing security checks or platform requirements; Composer reported no known vulnerability advisories.
- Upgraded only the Inertia server adapter to 2.0.28 because the 1.x line stops at Laravel 12. React, Vite, Tailwind, and all JavaScript dependencies remain unchanged.
- Replaced direct framework CSRF alias references with `PreventRequestForgery` while keeping the application's legacy middleware class and kernel structure.
- Added Laravel 13's cache unserialization hardening (`serializable_classes => false`). No application cache calls store PHP objects.
- Kept session serialization explicitly set to `php` so deployment does not invalidate active sessions.
- Audited all Laravel 13 guide impact areas. There are no application `upsert` calls, custom affected framework-contract implementations, legacy `array_first` / `array_last` helpers, queue event property references, or affected container calls.
- Preserved 342 routes, 207 API routes, and all 49 mobile API v1 routes. Laravel 13 exposes route-model binding keys and the new `QUERY` method in `route:list`; after normalizing those framework representation changes, route methods, paths, and names match Laravel 12.
- Ran all 98 migrations successfully against `/workspace/.cloud-setup/laravel13.sqlite`.
- Passed the Laravel 13 smoke set (6 tests, 6 assertions), Sanctum/mobile API regression set (2 tests, 8 assertions), and complete suite (20 tests, 26 assertions) on isolated database copies.
- Updated the tracked Docker and Sail definitions to PHP 8.4 and included the required HTTP/Raphf extensions. `docker compose config --quiet` passes (with expected warnings when local `.env` variables are absent).
- A separate `composer audit --locked` retry cannot reach `https://packagist.org/api/security-advisories/` from this environment (CONNECT tunnel HTTP 403). The successful final `composer update` performed its integrated advisory check and reported no known advisories.

## Final backend verification (2026-11-16)

- Added `.github/workflows/backend-ci.yml` for PHP 8.4, Composer 2, the required HTTP/Raphf and database extensions, MySQL 8.0, platform validation, dependency auditing, route inventory checks, migrations, and the complete Laravel test suite.
- Ran all 98 migrations against a disposable, tmpfs-backed MySQL `8.0.46` database. No production database, credentials, or customer data were used.
- Seeded only the three language records required by the existing page controllers; the complete suite then passed on MySQL: 21 tests and 73 assertions.
- Replaced `AllRoutesTest`'s unconditional assertions with explicit status contracts for 12 stable public endpoints, login redirects for all five protected panels, and registration-only checks for known placeholder routes.
- Expanded mobile API v1 coverage to assert the complete 49-route inventory, the 34 Sanctum-protected / 15 public split, methods and middleware for nine critical endpoints, unauthenticated rejection, token persistence, and authenticated access.
- Backend tests now call Laravel's `withoutVite()` helper, so clean CI checkouts do not require ignored frontend build artifacts. No React, Vite, Tailwind, or JavaScript dependency was changed.
- Laravel bootstrapping remains `13.42.0`; route inventory remains 342 total, 207 API, and 49 mobile API v1 routes.
- The local network still blocks Packagist's standalone Composer advisory endpoint with CONNECT tunnel HTTP 403. GitHub Actions successfully ran `composer audit --locked --abandoned=report` against Packagist with no security advisories; the already-documented abandoned Amadeus package remains a reported risk.

## Phase C exact versions

| Package | Version |
| --- | --- |
| PHP | 8.4.27 |
| Composer | 2.11.2 |
| laravel/framework | v13.42.0 |
| laravel/sanctum | v4.4.0 |
| laravel/fortify | v1.42.0 |
| laravel/scout | v11.10.0 |
| laravel/tinker | v3.1.0 |
| inertiajs/inertia-laravel | v2.0.28 |
| livewire/livewire | v3.8.11 |
| matchish/laravel-scout-elasticsearch | v7.14.3 |
| spatie/laravel-google-cloud-storage | 2.4.2 |
| spatie/laravel-medialibrary | 11.23.13 |
| nunomaduro/collision | v8.9.6 |
| spatie/laravel-ignition | 2.13.0 |
| phpunit/phpunit | 12.5.44 |

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
- Known placeholder and incomplete routes (`test`, `test2`, `mailable`, `blog`, and Laratrust management pages) are asserted only as registered contracts; CI does not represent them as functionally healthy.
- External booking/payment providers were not contacted; route registration and package compatibility are verified without production credentials.
- Composer reports `amadeus4dev/amadeus-php` as abandoned with no suggested replacement. It remains installed to preserve the existing flight integration.
- Composer reports pre-existing PSR-4 path/namespace mismatches in backup seeders and several request/resource/controller classes. Package discovery succeeds, but those classes need a separate compatibility review if exercised.
- Several legacy event tests remain conditional no-ops when `TEST_ENABLED=false`; external SMS, mail, booking, and payment behavior still requires credentialed staging verification.

## Outstanding production verification

- Exercise real booking, payment, Amadeus, Elasticsearch, Google Cloud Storage, SMS, and email integrations in a credentialed staging environment.
- Replace or formally accept the abandoned `amadeus4dev/amadeus-php` dependency.
- Strengthen `AllRoutesTest` so unexpected 4xx/5xx responses fail instead of only being logged.
- Resolve the pre-existing PSR-4 mismatches and the separate frontend `tour` / `Tour.tsx` case-sensitive import issue.

## Exact next action

Review Pull Request #1 and run the listed credentialed staging checks. Do not merge until those deployment risks are accepted or resolved.

