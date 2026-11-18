# Teacher creation: verified form and persistence contract

Base main 09bdcec966f3a39133d16f0d9fbad32d3f99db58 includes owner-merged #33. Active caller: teacher-panel/views/tsx/tours/AddTour.tsx. It posts to the existing tours.store route and expects the existing plain boolean success (HTTP 200 body 1). No mobile route or response changes.

The active city autocomplete sends a city ID as location_id; this maps to tours.city_id. Its country/city lookup tables have no language_id column, so the invalid teacher-only lookup filters are removed. The form has no language selector; resolve the configured API locale to Language.slug, rather than assuming row 1. An unavailable configured language returns validation failure, not an arbitrary language. API locale propagation from a language-switching UI remains a separate integration concern.

The age slider is 1–99 and defaults to 20–37; itinerary controls use inclusive positive start/end day numbers up to 50. Preserve the existing duration convention: days is the largest submitted end day, nights is days minus one. Sort submitted entries by start/end for persistence. This does not invent a gap/overlap or calendar-date policy. Description/title limits retain the existing request bounds. Transport is nullable because its selector is commented out in the active form and its database column is nullable. Empty optional highlights/includes/excludes/skills are supported.

The form now submits current state (not stale previous-keystroke values), sends the displayed defaults and has an actual Save tour submit button. The old Save Draft label had no submit handler; the saved status remains the server's Pending status. No publication control, redesign or media handling is introduced.

The owner approved nullable tours.certification_id for new Pending tours. Migration changes only nullability, preserving all existing values; rollback refuses to restore NOT NULL while null references exist. It performs no backfill, deletion or production migration. Teacher requests cannot set owner, teacher name or approval status. No arbitrary certificate is assigned.

Certificate templates currently have only id/name/url and no verifiable ownership/issuance-eligibility mapping. Explicit non-null selection therefore fails closed with 422 rather than claiming that an arbitrary template is eligible. Existing references are untouched. Before enabling certificate selection or publishing tours that require issuance, define the ownership/eligibility relation and the per-tour issuance requirement; the admin tour update method is currently empty. This PR does not create an approval/publication path. New tours remain Pending and fail public visibility checks.

Tour and all related rows are saved in one transaction. Includes use TourInclude, exclusions use TourExclude, and the return occurs after every itinerary is saved. A synthetic failure on the second itinerary proves earlier child writes and the tour roll back together. No media is moved or deleted.

The active overview/day fields are plain textareas. New overview and day-description writes reject markup delimiters because public legacy renderers accept HTML; existing stored content is not rewritten. This avoids opening a new stored-script path through the repaired form.
