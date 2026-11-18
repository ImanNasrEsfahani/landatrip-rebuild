# Registration and availability boundary characterization

Base main: f0cd43c34ee9ef5ba4ebc7d08c0a965d0fb6df54, owner-merged PR #32. This PR adds tests and documentation only. No production logic, route, schema, price or capacity policy changes.

Synthetic MySQL fixtures freeze the clock in the configured application timezone. Opening and closing dates are currently inclusive calendar dates, not timestamp cutoffs: opening midnight and closing day's last second admit registration; the preceding and following days do not. Tests compare the public availability API, authenticated booking step and verified commercial checkout entry point.

The public API retains its data envelope, stored amount/currency/symbol fields, remaining-capacity field and registration_open boolean. Closed-but-visible published groups remain readable with registration_open=false; private, draft and canceled groups return 404. All other published statuses are visible but only registration status opens registration. Guests may read public availability; booking step requires authentication and commercial checkout also requires verification. Commercial checkout always stays HTTP 409 and no invoice or transaction is created.

Capacity tests deliberately characterize current behavior, without approving it: all group_users pivot rows count, including pending, rejected, canceled, completed and reservation. Zero remaining seats and over-capacity groups are closed. The API currently returns a negative raw remainder when over capacity; this PR does not clamp it or reinterpret the business rule. The product owner must approve status inclusion, holds, expiry/release and oversubscription rules before changing those assertions or production logic.

The boundary group can be run with `php artisan test --group=registration-boundaries`; full CI also runs it. Legacy card placeholder pricing is outside this PR; tests validate stored price items rather than treating a sample card price as a real quote. Pricing, currency conversion, tax, quantities and gateway decisions are still unresolved. Do not activate commercial checkout or production providers.
