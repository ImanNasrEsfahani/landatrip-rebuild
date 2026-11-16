# E2E test matrix

The tests use real Chromium, Laravel, and MySQL. Fixture users are verified and carry the real Laratrust roles. Each browser test gets a separate session context.

| Feature | Role | Method | Coverage | Evidence / manual follow-up |
| --- | --- | --- | --- | --- |
| Home, about, tour list, browser history | Public | Chromium | HTTP 200, title, visible paint, asset responses, DOM, navigation, history | `e2e/public.spec.ts`; home screenshot. Tour filter currently uses static card data. |
| Tour detail and availability | Public | Chromium + seeded MySQL | Detail content, local JS/CSS URLs, group capacity API | `e2e/public.spec.ts`; tour screenshot. Raw stored price items are shown; payable pricing rules remain undefined. |
| Contact form, mobile viewport | Public | Chromium | Render at 390×844; submission withheld because it calls reCAPTCHA | Contact screenshot; sandbox reCAPTCHA still needed |
| Login, session reload, panel root, cross-role page/API denial, logout | User, teacher, agent, manager, admin | Chromium | One isolated browser test per role; teacher tour list and admin ticket form render | `e2e/panels.spec.ts`; panel and admin ticket screenshots |
| Mobile API v1 login, profile, logout | User | HTTP API from Playwright | Anonymous rejection, temporary Sanctum token, authenticated profile, token expiry | `e2e/mobile-api.spec.ts` |
| Tour search, availability, pricing | Public/user | Browser/backend | Listing and seeded detail only | Search/filter and pricing rules still need fixtures and tests |
| Booking entry | User | Chromium + seeded MySQL | Authenticated step one renders the seeded tour, group, and capacity | `e2e/public.spec.ts`; booking screenshot. Sidebar now shows stored price items and blocks an unverified total. |
| Booking creation and invoice | User | Chromium + MySQL + backend | Safe blocking verified: unpriced purchase returns 409 and creates no invoice or transaction; group/date/capacity and owner checks have feature tests | Product pricing contract in `BOOKING_PRICING_DECISION.md` is required before a payable invoice can be built. |
| Payment success/failure and duplicate callbacks | User/admin | Laravel feature test + mocked gateway | Existing invoices: success, failure, duplicate callback, second transaction for paid invoice, retryable provider error | No new invoice/payment flow until pricing is defined. |
| Instructor tour management | Teacher | Chromium + API | Panel root and seeded tour list | Create/edit workflow still unverified; form and upload fixtures needed |
| User booking history | User | Chromium panel + invoice API | Panel renders and invoice API is compared before/after blocked purchase; invoice owner show is tested | A new paid booking cannot be shown until invoice creation rules are defined. |
| File upload validation | Authenticated | None | Not verified | Add local fake storage and size/type tests |

Only rows with a successful test execution in `E2E_EXECUTION_REPORT.md` should be treated as passing. A panel root rendering does not prove its forms or business actions.

The 2026-11-16 local run passed 29 Laravel tests, the Vite build/SSR/12-entry manifest check, and the Chromium suite after the test fixture and asset build setup. Checkout completion remains blocked by the documented pricing decision.
