# Next independent task: teacher multi-day itinerary persistence

Prepare a separate PR after the boundary-test PR is reviewed; no teacher write behavior is changed here.

Verified code: TeacherPanel TourController::store saves the tour and child rows without an enclosing transaction, returns inside the itineraries loop (only the first is saved), and creates excludes using TourInclude. update terminates at dd("Tour update"). StoreTeacherTourRequest leaves age/start/end weakly validated and hardcodes language in the controller. Tour and itinerary persistence fields must be reconciled with the actual teacher form payload and required schema columns before claiming a working creation flow.

First slice: use synthetic teacher-owned tours and two or more itinerary entries to reproduce partial persistence. Preserve verified form fields and success response; move the return after all itinerary saves, use the correct exclusion model, and make tour/child persistence transactional. Test failure rollback, correct day ordering, every entry retained, owner identity and cross-teacher denial. Preserve media IDs and route names. Do not combine storage migration, prices or payments with this fix.

Editing should then be its own bounded change: establish the update payload from the active frontend, authorize ownership before any write, validate child IDs belong to that tour, and update/reconcile children transactionally without deleting media. Explicitly define whether missing children mean removal; do not guess a destructive replacement contract. Teacher panel private-tour access must remain separate from public visibility scopes.

Decisions to resolve from current UI or owner before changing behavior: city/location and language mapping, inclusive day ranges and gap/overlap rules, nights derivation, and update omission/deletion semantics. Do not infer these from legacy defaults or sample data. Pricing/tax/currency/capacity/payment approval remains a separate activation gate. Use disposable MySQL, synthetic files and fake providers only.
