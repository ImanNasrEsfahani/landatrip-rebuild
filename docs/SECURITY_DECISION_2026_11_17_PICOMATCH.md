# Security decision: temporary picomatch advisory acceptance (retired)

**Retired 2026-11-18:** GitHub withdrew [GHSA-fc5q-39xc-vjpf](https://github.com/advisories/GHSA-fc5q-39xc-vjpf) at `2026-11-18T15:38:56Z`. On verified main `ff9c71c663fd18c14052e5deb736c732d770ae34`, both `npm audit --audit-level=high` and `npm audit --omit=dev --audit-level=high` report zero vulnerabilities. The temporary exception is retired before its original December 1 deadline. No dependency version, audit threshold, or CI enforcement was changed. Continue both audit jobs and reassess any new finding on its own evidence.

The original decision below is retained as a historical record; statements about active findings and exception review dates describe the decision when made.

**Decision:** The repository owner approved a temporary exception for GHSA-fc5q-39xc-vjpf on 2026-11-17. It applies only to the documented development and build dependency paths. It expires **2026-12-01**. Review the advisory weekly, beginning **2026-11-24**. This decision does not establish production readiness or authorize deployment.

The locked dependency graph includes `picomatch` 4.0.7 and nested 2.3.2 copies. The affected paths run through Vite and its glob utilities; `@rollup/plugin-inject`/`@rollup/pluginutils`; Sass's optional watcher; Tailwind's glob and watcher tools; and `laravel-vite-plugin`/`vite-plugin-full-reload`. The full npm audit reports 16 high findings propagated from this advisory. The production-only audit reports zero findings. The advisory describes regex denial of service from a crafted repeated extglob pattern and currently lists no patched version.

Repository-defined build configuration supplies the current glob patterns. No application route or browser feature was found that passes an untrusted user-controlled glob pattern to the vulnerable package. The residual risk is build or CI availability if a future configuration, plugin, or untrusted contribution introduces such a pattern.

**Controls during the exception:** Keep the full `npm audit --audit-level=high` running and visibly failing on the finding. Run `npm audit --omit=dev --audit-level=high` as a separate enforced CI job. Maintain the production client build, Vite manifest and SSR checks, backend, E2E, security, and ARM64 checks. Keep glob patterns repository-controlled, preserve CI timeouts, and review dependency and build-configuration changes. Do not suppress findings or force an incompatible dependency change.

**Reassess immediately** if a compatible patch appears, a production dependency or user-controlled pattern path is found, build or CI denial of service is observed, or advisory severity or the dependency graph changes materially. Otherwise review weekly and either remediate or renew this decision explicitly by 2026-12-01. The full audit result remains a distinct, failing signal throughout this exception.
