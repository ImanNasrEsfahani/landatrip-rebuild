# Runtime credential and media guardrails

The application supports protected runtime configuration for cloud services. Prefer workload identity or application default credentials when available. If `GOOGLE_CLOUD_KEY_FILE` is used, mount a readable credential file outside the repository and web root. Do not commit credentials or put them under public storage. `GOOGLE_PLACES_API_KEY` is available through Laravel service configuration for callers that use the Places API.

New public uploads, private runtime files, and common credential file types are ignored by Git. Ignore rules do not remove files that are already tracked and can be bypassed by force-add, so changed-file secret scanning remains required.

The staging web configuration denies direct requests to temporary uploads, user documents, and secret-like storage file extensions. It continues to serve intended public media and built website assets. Moving existing media to private storage requires a separate, verified backup and reference-preserving migration.

The isolated Apache test setup requires the application URL, asset URL, and Sanctum stateful domain to use the same HTTPS origin. The setup fails early when these values do not match its test port.
