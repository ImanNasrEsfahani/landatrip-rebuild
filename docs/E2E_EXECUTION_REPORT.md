# Phase 3 execution report

## Local run, 16 November 2026

The isolated `landatrip-e2e` Compose stack is running at `http://127.0.0.1:8000`. Its disposable MySQL 8.0 database was rebuilt and all 98 migrations passed. The PHP image is PHP 8.4.27 with Laravel 13. The local host used Node 24.22.1 and system Chromium 156; GitHub Actions is configured for Node 22.12 and Playwright Chromium. CI results must be checked on the pull request before merge.

| Gate | Result | Evidence |
| --- | --- | --- |
| Laravel tests on isolated MySQL | 24 passed, 101 assertions | `php artisan test` in the E2E PHP container |
| Frontend build and manifest | Passed; 12 Vite entry points including five panels, SSR bundle built | `npm run test:frontend` |
| npm dependency audit | 0 vulnerabilities at high severity threshold | `npm audit --audit-level=high` |
| Composer metadata and platform | `composer validate --no-check-publish` and `composer check-platform-reqs --no-dev` passed | PHP 8.4 E2E container |
| Composer online advisory audit | Could not complete locally: the environment's proxy returned HTTP 403 for Packagist's advisory endpoint | `composer audit --locked --no-interaction --abandoned=report`; GitHub backend CI repeats it |
| Playwright Chromium | 10 passed, one worker, no retries | `bash scripts/e2e-run.sh`; `playwright-report/index.html` |

## Browser and workflow evidence

| Feature and role | Method and outcome | Screenshot / remaining verification |
| --- | --- | --- |
| Home, about, tour list, navigation and history; public | Chromium HTTP, DOM, paint, local asset and console assertions passed | `test-results/home-desktop.png`; tour list still uses static cards |
| Seeded tour detail and availability; public | Chromium detail and API capacity of 8 passed | `test-results/tour-detail.png`; price rules unverified |
| Contact page; public mobile 390×844 | Chromium render passed | `test-results/contact-mobile.png`; submission needs sandbox reCAPTCHA |
| Login, reload, panel render, cross-role page and API denial, logout; user, teacher, agent, manager, admin | Five Chromium scenarios passed with synthetic Laratrust users | `test-results/{role}-panel.png`; deeper role forms remain in the matrix |
| Teacher seeded tour list; teacher | Authenticated panel API returned the fixture; Chromium scenario passed | Tour create/edit requires a full fixture and upload contract |
| Admin landing and ticket form; admin | Chromium heading, navigation, and visible form controls passed | `test-results/admin-ticket-form.png`; no ticket was submitted |
| Booking step one; user | Authenticated Chromium page displayed seeded tour, group, capacity, and sidebar | `test-results/booking-step1.png`; sidebar price is hardcoded and purchase was not invoked |
| Payment callback; backend with mocked provider | Verified success marks invoice paid, failure stays unpaid, duplicate callbacks dispatch once, and provider error keeps transaction pending | `tests/Feature/PaymentCallbackTest.php`; provider sandbox and purchase path unverified |
| Mobile API v1; user | Anonymous request rejected; synthetic Sanctum token can log in, read profile, log out, and is then rejected | `e2e/mobile-api.spec.ts` |

The HTML report and screenshots are local generated artifacts excluded from Git. The E2E CI workflow uploads `playwright-results` on every run. Failure traces are configured for capture. Browser tests abort requests to nonlocal hosts, and no live purchase, booking, or customer notification was made.

## Manual checks before staging promotion

1. Confirm the pull request's backend, frontend, and Chromium workflows pass from a fresh checkout, including the Composer advisory audit.
2. Define the group pricing source, replace the booking sidebar's fixed totals, and verify invoice creation with a fake gateway before sandbox payment testing.
3. Exercise provider sandbox purchase, failed payment, success, retries, and duplicate callbacks without customer data.
4. Supply sandbox reCAPTCHA and test contact form validation and submission.
5. Test teacher tour create/edit, user booking history, admin ticket submission, and file upload validation using disposable records and local fake storage.
6. Review static tour listing data, third party assets, and remaining issues in `KNOWN_ISSUES.md` before exposing any staging URL.
