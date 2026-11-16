# Known issues and remaining risks

| Item | Status | Required follow-up |
| --- | --- | --- |
| Booking/payment integration | Booking step one renders with stored price items. A purchase attempt is safely blocked before an invoice or provider call. Callback success, failure, duplicates, and provider errors pass with a mocked Shetabit gateway for existing invoices. | Approve the pricing and reservation contract in `BOOKING_PRICING_DECISION.md`, then build and test the complete invoice and fake-gateway flow. |
| Booking code assumptions | The invalid `groups.price`, `51000` multiplier and fixed invoice user were removed from the reachable purchase path. Historical invoice detail rows lack a group ID; new rows can store one. | Define the pricing contract and backfill historical group IDs only where independently verifiable. |
| Contact submission | Calls external reCAPTCHA. | Provide a sandbox key or mock the verification boundary; then test validation and success. |
| Third party assets and providers | Browser blocks nonlocal requests. The app contains analytics and legacy hardcoded asset URLs. | Review network failures and use sandbox endpoints in staging. |
| Tour filter data | The public `/tour` filter currently renders static card data and does not expose the seeded tour in the list. | Connect it to the live tour query/API before claiming search and filtering work. |
| File upload route | The public temporary upload route points at a missing `tempStore` method; adjacent methods contain placeholders. | Define accepted file types and limits, then implement local fake storage tests. |
| Teacher tour editing | The teacher list is covered, but the existing create/update path has unverified fields and uploads. | Test a complete form submission with fixtures and repair only after confirming the expected contract. |
| Admin ticket workflow | The landing and new ticket form render. Submission and ticket assignment are unverified. | Seed a disposable ticket recipient and exercise validation and save through the isolated database. |
| Booking sidebar price | The sidebar now displays stored group price items without a fabricated total; invoice and payment mockups no longer show sample bills. | Approve quantity, currency, conversion, tax, discount, and reservation rules before enabling checkout. |
| Tour cards without uploaded images | A fallback thumbnail was added for the seeded group. | Exercise uploaded media and GCS in credentialed staging. |
| Historical dependencies | `amadeus4dev/amadeus-php` is abandoned; Sass emits deprecation warnings. | Plan a separate dependency review. |
| Role workflows | Panel roots and role denial are covered; forms and data mutations need deeper tests. | See the matrix and manual checklist. |

The E2E stack contains synthetic data only. Production traffic and customer data have not been used.

Before applying the new unique transaction-authority migration to staging, check for duplicate non-null authorities and reconcile them. The migration intentionally stops if duplicates are present.
