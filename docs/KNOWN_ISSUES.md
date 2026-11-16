# Known issues and remaining risks

| Item | Status | Required follow-up |
| --- | --- | --- |
| Booking/payment integration | Booking step one renders. Callback success, failure, duplicate, and provider error paths pass with a mocked Shetabit gateway. Purchase and Stripe Checkout were not invoked. | Repair invoice creation and pricing, then test end to end with a fake gateway and sandbox credentials. Never run these routes against production. |
| Booking code assumptions | Existing code uses a numeric `user_id` in invoice creation and calculates a group price field that is absent from the base `groups` migration. | Review the real booking data model and repair under a separate verified workflow. |
| Contact submission | Calls external reCAPTCHA. | Provide a sandbox key or mock the verification boundary; then test validation and success. |
| Third party assets and providers | Browser blocks nonlocal requests. The app contains analytics and legacy hardcoded asset URLs. | Review network failures and use sandbox endpoints in staging. |
| Tour filter data | The public `/tour` filter currently renders static card data and does not expose the seeded tour in the list. | Connect it to the live tour query/API before claiming search and filtering work. |
| File upload route | The public temporary upload route points at a missing `tempStore` method; adjacent methods contain placeholders. | Define accepted file types and limits, then implement local fake storage tests. |
| Teacher tour editing | The teacher list is covered, but the existing create/update path has unverified fields and uploads. | Test a complete form submission with fixtures and repair only after confirming the expected contract. |
| Admin ticket workflow | The landing and new ticket form render. Submission and ticket assignment are unverified. | Seed a disposable ticket recipient and exercise validation and save through the isolated database. |
| Booking sidebar price | The first step displays a hardcoded course price and tax. | Connect the UI to a reviewed pricing model before relying on totals or creating invoices. |
| Tour cards without uploaded images | A fallback thumbnail was added for the seeded group. | Exercise uploaded media and GCS in credentialed staging. |
| Historical dependencies | `amadeus4dev/amadeus-php` is abandoned; Sass emits deprecation warnings. | Plan a separate dependency review. |
| Role workflows | Panel roots and role denial are covered; forms and data mutations need deeper tests. | See the matrix and manual checklist. |

The E2E stack contains synthetic data only. Production traffic and customer data have not been used.
