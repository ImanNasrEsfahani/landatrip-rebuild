# Upgrade Laravel 10 to Laravel 13

## Summary

- Upgrade Laravel incrementally through verified Laravel 11 and Laravel 12 checkpoints to Laravel 13.42.0.
- Require PHP `^8.3` and provide a verified PHP 8.4 runtime with `ext-http` / Raphf.
- Upgrade Sanctum to 4.4.0, Scout to 11.10.0, Tinker to 3.1.0, PHPUnit to 12.5.44, and compatible backend packages.
- Preserve the legacy application layout, all 342 routes, the 207-route API surface, all 49 mobile API v1 routes, the customized Sanctum token schema, and the existing frontend dependencies.
- Add focused mobile API v1 and Sanctum token regression coverage.
- Adopt Laravel 13 request-forgery protection and cache unserialization hardening while retaining PHP session serialization so existing sessions are not intentionally invalidated.

## Checkpoints

- Laravel 11: `fb9c9e45` (`v11.57.1`)
- Laravel 12: `6801dd68` (`v12.72.0`)
- Laravel 13: final commit containing this PR description (`v13.42.0`)

## Verification

- `composer validate --no-check-publish`: passed.
- `composer check-platform-reqs --no-dev`: passed on PHP 8.4.27.
- Composer advisory check during the final update: no known vulnerability advisories. A subsequent standalone `composer audit --locked` could not reach Packagist's advisory endpoint from this environment (CONNECT tunnel HTTP 403).
- Route inventory: 342 total, 207 API, 49 mobile API v1; normalized Laravel 12/13 signatures match.
- Fresh isolated SQLite migration: all 98 migrations passed.
- Selected Home/About smoke suite: 6 tests, 6 assertions passed.
- Sanctum/mobile API regression suite: 2 tests, 8 assertions passed.
- Complete suite: 20 tests, 26 assertions passed.
- Docker Compose configuration: valid for the PHP 8.4 Sail runtime with HTTP/Raphf extensions.

## Reproduce

Using the prepared repository runtime:

```bash
/workspace/.cloud-setup/php composer install
/workspace/.cloud-setup/php php artisan --version
/workspace/.cloud-setup/php composer check-platform-reqs --no-dev

touch /workspace/.cloud-setup/laravel13-review.sqlite
APP_ENV=testing DB_CONNECTION=sqlite DB_DATABASE=/workspace/.cloud-setup/laravel13-review.sqlite \
  CACHE_STORE=array SESSION_DRIVER=array QUEUE_CONNECTION=sync MAIL_MAILER=array SCOUT_DRIVER=null \
  /workspace/.cloud-setup/php php artisan migrate:fresh --force

cp /workspace/.cloud-setup/development.sqlite /workspace/.cloud-setup/laravel13-review-tests.sqlite
APP_ENV=local DB_CONNECTION=sqlite DB_DATABASE=/workspace/.cloud-setup/laravel13-review-tests.sqlite \
  CACHE_STORE=array SESSION_DRIVER=array QUEUE_CONNECTION=sync MAIL_MAILER=array SCOUT_DRIVER=null \
  /workspace/.cloud-setup/php php artisan test
```

The tracked Sail configuration uses PHP 8.4. Keep MySQL at the existing 8.0 release:

```bash
docker compose build laravel.test
docker compose up -d
```

## Outstanding risks

- The abandoned `amadeus4dev/amadeus-php` package has no suggested replacement and remains to preserve the flight integration.
- External booking, payment, Amadeus, Elasticsearch, Google Cloud Storage, SMS, and email integrations were not called without staging credentials.
- The legacy `AllRoutesTest` logs several pre-existing 404/500 responses but does not assert them.
- Composer reports pre-existing PSR-4 mismatches in backup seeders and several application classes.
- The frontend `tour` / `Tour.tsx` case-sensitive import issue predates and is separate from this backend upgrade.
- Laravel 11 is a historical checkpoint covered by five advisories; the final Laravel 13 lock reports none.

## Deployment notes

- Required PHP: `^8.3`; verified on PHP 8.4.27.
- Run normal database migrations; do not replace the customized Sanctum token migration.
- Existing cache entries containing PHP objects are intentionally rejected unless an explicit allow-list is added.
- Session serialization remains PHP to avoid intentionally signing out current users.
