# Phase 5: isolated checkout contract and activation decisions

## Verified design boundary

The live booking entry point remains blocked with HTTP 409. The synthetic API is under `/api/__e2e/checkout` and every handler checks **all** of the following: `BOOKING_TEST_CHECKOUT_ENABLED=true`, `BOOKING_TEST_GATEWAY=fake`, local or testing application environment, MySQL connection, database name exactly `landatrip_e2e`, and a positive configured hold duration. No synthetic route calls the payment facade, Stripe, mail, SMS, or a travel provider. A passing fake callback cannot activate live checkout.

The versioned server contract is `synthetic-cad-v1`. `group_price_items` identifies mandatory versus optional items, category, version, currency, and a `DECIMAL(12,2)` unit amount. The fixture has one mandatory **CAD 42.35** adult item and one optional **CAD 7.20** adult extra. It also retains a USD item to prove mixed currency rejection. These values are synthetic arithmetic fixtures and have no commercial meaning. Only the `adult` category is supported by this fixture; all other categories are rejected. One mandatory item is required for each supported category. Optional quantities are explicit and may not exceed participant count. Empty, duplicate, invalid, cross-version, and cross-currency selections are rejected.

Amounts are parsed from decimal strings into integer CAD cents. Multiplication and summation use integers. The fixture uses an explicit **0% tax** and **zero discount**; neither is a live policy. The contract defines tax as basis points on subtotal after discount, with half-up rounding to the nearest cent. The fake gateway amount is an integer count of CAD cents. No exchange or implicit currency conversion occurs.

On invoice creation, the server locks the selected group, removes expired holds, checks capacity, and writes the invoice, its exact selected group details, immutable price snapshot, and hold in one database transaction. The invoice belongs to the authenticated user. A checkout key and pricing fingerprint suppress duplicate creation; reusing a key for a different selection returns 409. Payment initiation creates one fake transaction and authority per invoice. Its callback updates an active invoice and hold once. Success books capacity; failure releases it; expiry marks the invoice and transaction terminal and releases capacity. Duplicate or reversed callbacks do not change terminal states. A fixture-only scheduled sweep runs every minute when the isolation gate is satisfied; invoice creation also cleans expired holds for the selected group. Test-only fixture endpoints can advance a hold to expiry. The fixture hold is **15 minutes only**. No live hold duration has been approved.

## Decisions required before production checkout

1. Approve the base fare and optional service catalog, participant categories and age boundaries, quantities, price validity dates, and who may purchase for companions.
2. Approve the settlement currency and whether conversion is allowed. If so, specify the rate source, timestamp, precision, and rounding sequence.
3. Approve tax jurisdiction and exemptions, coupons and discount order, invoice legal content, and invoice expiry.
4. Approve capacity-consuming reservation states, hold duration, expiry scheduler, retry and cancellation rules, and treatment of legacy `group_users` bookings.
5. Select a gateway per currency and define its minor unit convention, signed callback verification, reconciliation, refund, and failure contracts.
6. Approve the invoice and reservation lifecycle for production, including notification and downstream booking integration behavior.

Live checkout requires approved and versioned commercial rules, provider credentials and callback verification, migration and reconciliation of legacy payment authority data, production-safe capacity cleanup, integration tests against provider sandboxes, and an explicit code path that replaces the current HTTP 409 gate. None of those activation conditions are met by the synthetic fixture.

## Verification

Run `bash scripts/e2e-run.sh` for disposable MySQL 8, locked dependencies, Laravel migration and seeding, and Playwright Chromium. Run `php artisan test` inside the E2E PHP container and `npm run test:frontend` for the remaining CI gates. The Chromium suite checks five panels, mobile API v1, and the synthetic quote through callback flow. The fixture endpoints are only intended for this isolated database.

Local verification on 2026-11-16: 31 Laravel tests passed; the React/Vite client and SSR bundles built and all 12 manifest entry points validated; the complete Chromium suite passed 12 tests; and the final browser-driven checkout test passed again against a freshly seeded MySQL 8 database. `npm audit --audit-level=high` reported zero vulnerabilities. Composer validation and platform requirements passed. The local Composer advisory request could not complete because the network proxy returned HTTP 403; the pull request backend CI must supply that check.
