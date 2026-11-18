# First database-backed public tour list

GET /tour keeps its existing route and Blade/React/Material UI shell. The controller supplies a whitelist of title, summary, ID, public group count and existing detail URL via escaped JSON. No new API route is added; mobile routes and responses are unaffected. Existing Inertia usage elsewhere is preserved.

Visible tours are approved and in the current application language. Only non-draft/non-canceled groups in that language count as published; this count is not bookable availability or remaining seats. Tours with no published group have no detail link in the list. No group fields, private owner details, prices, ratings, currency conversions or invented availability are returned. Existing detail-page visibility is a separate next task.

Title search is server-side, bounded to 100 characters and treats percent/underscore as literal search text. Pagination is fixed at 12 with deterministic title/ID ordering. A correlated count avoids per-card relationship queries. Real filters replace the old static controls in the first slice: only title search and pagination are shown; dates, sort by price/rating and sidebar controls will return when backed by real semantics. Material UI theme, spacing and card treatment remain.

Next tasks in order: detail/group visibility and availability; teacher multi-itinerary creation/editing; profile and support forms; approved pricing/currency/tax/capacity contract and fake gateway lifecycle; provider sandboxes after explicit approval. Commercial checkout remains HTTP 409. This development slice does not declare production readiness or change stored media.
