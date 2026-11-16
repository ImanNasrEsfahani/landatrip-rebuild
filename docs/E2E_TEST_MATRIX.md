# E2E test matrix

The tests use real Chromium, Laravel, and MySQL. Fixture users are verified and carry the real Laratrust roles. Each browser test gets a separate session context.

| Feature | Role | Method | Coverage | Evidence / manual follow-up |
| --- | --- | --- | --- | --- |
| Home, about, tour list, browser history | Public | Chromium | HTTP 200, title, visible paint, asset responses, DOM, navigation, history | `e2e/public.spec.ts`; home screenshot. Tour filter currently uses static card data. |
| Tour detail and availability | Public | Chromium + seeded MySQL | Detail content, local JS/CSS URLs, group capacity API | `e2e/public.spec.ts`; tour screenshot. Pricing remains unverified. |
| Contact form, mobile viewport | Public | Chromium | Render at 390×844; submission withheld because it calls reCAPTCHA | Contact screenshot; sandbox reCAPTCHA still needed |
| Login, session reload, panel root, cross-role page/API denial, logout | User, teacher, agent, manager, admin | Chromium | One isolated browser test per role | `e2e/panels.spec.ts`; panel screenshots |
| Mobile API v1 login, profile, logout | User | HTTP API from Playwright | Anonymous rejection, temporary Sanctum token, authenticated profile, token expiry | `e2e/mobile-api.spec.ts` |
| Tour search, availability, pricing | Public/user | Browser/backend | Listing and seeded detail only | Search/filter and pricing rules still need fixtures and tests |
| Booking creation and invoice | User | None | Not verified | Existing booking path invokes payment provider; add an explicit fake gateway before automating |
| Payment success/failure and duplicate callbacks | User/admin | None | Not verified | Sandbox gateway and idempotency behavior require review |
| Instructor tour management | Teacher | Chromium + API | Panel root and seeded tour list | Create/edit workflow still unverified; form and upload fixtures needed |
| User booking history | User | Browser root only | Panel renders; history data unverified | Add isolated booking fixture |
| File upload validation | Authenticated | None | Not verified | Add local fake storage and size/type tests |

Only rows with a successful test execution in `E2E_EXECUTION_REPORT.md` should be treated as passing. A panel root rendering does not prove its forms or business actions.
