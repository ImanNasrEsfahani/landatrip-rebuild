# Runtime credential and media guardrails

The application supports protected runtime configuration for cloud services. Prefer workload identity or application default credentials when available. If `GOOGLE_CLOUD_KEY_FILE` is used, mount a readable credential file outside the repository and web root. Do not commit credentials or put them under public storage. `GOOGLE_PLACES_API_KEY` is available through Laravel service configuration for callers that use the Places API.

New public uploads, private runtime files, and common credential file types are ignored by Git. Ignore rules do not remove files that are already tracked and can be bypassed by force-add, so changed-file secret scanning remains required.

The staging web configuration denies direct requests to temporary uploads, user documents, and secret-like storage file extensions. It continues to serve intended public media and built website assets. Moving existing media to private storage requires a separate, verified backup and reference-preserving migration.

The isolated Apache test setup requires the application URL, asset URL, and Sanctum stateful domain to use the same HTTPS origin. The setup fails early when these values do not match its test port.

## Frontend dependency advisory

The locked development toolchain contains `picomatch` 4.0.7 and nested 2.3.2 copies. GitHub advisory GHSA-fc5q-39xc-vjpf describes a high-severity regular-expression denial of service from a crafted single-branch repeated extglob pattern. As of 2026-11-18, the advisory covers versions through 4.0.7, lists no patched release, and npm reports 4.0.7 as latest. The full npm audit reports 16 high findings through this advisory; `npm audit --omit=dev` reports zero findings.

The affected paths are development/build dependencies: Vite directly and through `tinyglobby`/`fdir`; `@rollup/plugin-inject` through `@rollup/pluginutils`; Sass through optional `@parcel/watcher`; Tailwind through `micromatch`/`fast-glob`, `chokidar`/`anymatch`/`readdirp`, and `sucrase`/`tinyglobby`; and `laravel-vite-plugin` through `vite-plugin-full-reload` and Vite. The project uses repository-defined Vite input, refresh, and plugin glob patterns. No application route or browser code was found that accepts a user-supplied picomatch pattern. Current exposure is primarily build or CI availability if an untrusted pattern reaches a tool; a public frontend runtime exploit path was not identified.

Frontend CI runs the production client build, manifest verification, and SSR build independently of a separate full npm audit job. The audit remains a failing check until a compatible patched dependency is available or an explicitly documented, narrowly scoped risk acceptance is approved. Do not force a breaking downgrade or suppress the finding without review.
