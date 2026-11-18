# Phase 13B first slice: public tour and group visibility

Base: owner-merged main 5fa081739faca93100f7ff3e1bd0c4ced13ca3fd, including #27 → #28 → #31 → #29 → #30. All five PRs were already merged when this task resumed; no automatic merge was performed.

Public web listing/detail, common tour-card API and booking entry points now share explicit visibility scopes: approved tour in the current language; public group in the current language, excluding draft/canceled status. Detail chooses the latest visible group with an ID tie-breaker; it returns 404 when no visible group exists. The list no longer counts private groups. These are explicit scopes, not global model filters: teacher-panel and mobile queries keep their existing authorized behavior.

No route, schema, stored media, price resource, capacity interpretation or commercial checkout rule changes. Registration/date/capacity checks remain in place; commercial checkout remains HTTP 409. Price display compatibility is retained; the legacy tour-card resource still contains a hardcoded price, which needs its own owner-approved display contract before replacement. This PR does not claim to fix availability or pricing.

Regression coverage: synthetic unpublished tour denial, private/draft/canceled/foreign-language group filtering, common booking API denial and no-public-group handling. Existing booking safety and public browser tests verify permitted paths. The booking test fixture now explicitly marks its intended public tour approved instead of relying on the draft schema default.

Next PR sequence: registration-window/availability boundary cases without inventing which participant statuses consume seats; then teacher multi-itinerary creation and update; profile/support forms; product-approved pricing, tax, currency, capacity and payment contract; fake gateway lifecycle; approved provider sandboxes. Preserve all 49 mobile v1 routes and the new authorized mobile upload behavior. No production readiness is implied.
