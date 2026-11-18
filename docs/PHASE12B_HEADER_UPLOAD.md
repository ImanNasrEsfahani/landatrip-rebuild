# Public profile header upload adapter

The existing profile-page Header FilePond uses multipart `files` at POST /api/user/{user}/header and expects a plain Image ID, HTTP 200. The old request validated `image` instead; the controller dereferenced files without validation, used a timestamp and identity filename, and wrote directly to the configured default disk. Missing input could raise 500 and executable bytes were not rejected.

Keep the actual field, Image-ID response and authenticated-user-only mutation (the path user was already ignored). Validate JPEG/PNG/WebP images up to 2 MiB, then create and consume an owned temporary upload through the Phase 12 service. New header names are UUIDs on the explicit public disk at users/header. A profile header is intentionally public; this does not make documents or ticket attachments public. Previous header images and source copies are preserved. No new route or schema changes.

Synthetic HTTP tests cover missing/invalid files, authentication, existing response type, server filename and authenticated-user scope. Legacy image filenames are not changed. EXIF stripping and retention remain separate work.
