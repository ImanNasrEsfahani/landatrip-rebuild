# Phase 12 verified development baseline and next work

## Base and evidence

Main `ff9c71c663fd18c14052e5deb736c732d770ae34` includes owner merges #18, #20, #21, #19, #22 and #23. Supplied main `2318b0b745de0ee7e29c170ecf942413f8e74387` is its ancestor; only the manual E2E and Apache workflow triggers differ in the final tree. Repository PUBLIC; Issue #15 OPEN. The existing encrypted backup was not accessed or changed.

Disposable MySQL/PHP 8.4 local baseline: 66 backend tests / 382 assertions, five fixture-only skips. Fresh E2E seed: four checkout-isolation tests / 53 assertions and 13 Chromium tests pass. Client production build, SSR and all 12 manifest entry points pass. Route inventory: 349 total / 214 API / 49 mobile v1. Both npm audits: zero vulnerabilities. Gitleaks v8.30.1 with redaction finds zero current-tree findings in a Git archive; the added main commit range also passes. This is not a Git-history clearance.

Exact baseline hosted runs:
- [E2E](https://github.com/ImanNasrEsfahani/landatrip-rebuild/actions/runs/44396135951)
- [Apache](https://github.com/ImanNasrEsfahani/landatrip-rebuild/actions/runs/44396141426)
- [Protected disposable staging](https://github.com/ImanNasrEsfahani/landatrip-rebuild/actions/runs/44396148708)
- [ARM64](https://github.com/ImanNasrEsfahani/landatrip-rebuild/actions/runs/44396209094) built from validation/phase12-baseline at the same SHA; images were not published. Main dispatch would publish images, so this verification used the validation branch.

Difference from pre-merge combined evidence: two document mutation tests from #22 are now present (66 versus 64 backend passes); route counts and 13 E2E tests match. No observed regression. Build warnings remain for large frontend chunks and deprecated Sass features.

## Code-verified ordered functional roadmap

1. Complete owner review of the Phase 12 exception retirement, upload ownership and new private ticket attachments PRs. Merge dependencies in order manually and rerun after each main update. Apply nullable migrations only through a separately approved environment rollout. Communicate that old temporary IDs require re-upload.
2. Repair legacy upload adapter contracts in one small PR: `APIFileUploadController` has missing tempStore and placeholder restore/revert methods; mobile TourController::uploadFileToCloud writes bytes and stops at dd. Agree the intended mobile response before changing it. Add endpoint-level fixtures and retain the 49-route snapshot. Add expiry cleanup only after the retention/backup plan is accepted.
3. Public tour search: Web TourController::index renders the tour-filter view; the material-public Filter component uses static cards. Introduce a paginated query/API driven by existing tour/group data, then wire one filter at a time with fixture tests for empty results, visibility and pagination. Do not invent price totals or currency conversion.
4. Tour detail/availability: TourCardsController::show reads tour groups; BookingProcessController and Web TourController::booking enforce registration windows and compare group users against capacity. Test which statuses consume seats only after the reservation decision; keep the selected group and stored price-item display intact.
5. Teacher tour editor: TeacherPanel TourController::store hardcodes language 1, creates excludes as TourInclude, and returns inside the itinerary loop. Its update method is dd('Tour update'). Define one form contract, validate ownership, then repair transaction/itinerary persistence and update with synthetic multi-day fixtures. Keep uploads on the owned-upload service.
6. Profiles and support: finish profile field/validation and image replacement contracts, then ticket creation/assignment/rating/closing UI fixtures. Panel ticket backend authorization and selected-recipient creation were covered in Phase 11; do not redo them. The user rating handler still returns a placeholder rather than persisting ratings. Teacher document update is also a placeholder; test and implement it independently.
7. Booking lifecycle: Web TourController::booking now aborts 409 before commercial checkout. Historical statements in BOOKING_PRICING_DECISION.md about its old 51000 code describe the prior implementation. The unresolved pricing/currency/tax/capacity/provider decisions remain valid. Keep commercial checkout blocked until the owner approves those rules; then implement one versioned server quote/invoice contract using existing exact synthetic snapshots and fake gateway tests before any sandbox provider.
8. Provider boundaries: Api BookingController directly builds Amadeus for search/offers/details. Introduce a small injectable adapter and deterministic error/timeout fixtures; contact reCAPTCHA and payment/SMS/email must use approved sandbox boundaries. No real provider calls belong in tests.

KNOWN_ISSUES.md is a historical starting point: its ticket-submission statement predates the Phase 11 backend tests, and its upload issue remains valid for the missing legacy adapter even though numeric-ID web consumers gain protection in Phase 12. Update those rows when each scoped workflow is actually implemented and tested.

Development checks establish reproducibility and authorization behavior on synthetic data. Production readiness still requires owner key-rotation/history incident resolution (#15), verified private media preservation/migration, approved pricing and providers, a capacity/resource plan and separately approved deployment. Successful tests do not establish suitability of the existing 1 GiB server.
