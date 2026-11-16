# Frontend Modernization Decisions

Last updated: 2026-11-15

## F-001 — Preserve every existing Vite entry point

**Decision:** Keep the public, material public, React public, Inertia, admin, manager, teacher, agent, user, stylesheet, and SSR entries in the Vite configuration.

**Reason:** Blade layouts and the five panels load these bundles independently. Consolidating them would create unnecessary routing and UI risk.

## F-002 — Establish a working historical baseline first

**Decision:** Fix filesystem casing defects and prove the locked Vite 4 build before changing major dependencies.

**Reason:** This separates pre-existing source defects from upgrade regressions and provides a concrete comparison point.

## F-003 — Do not force React 19

**Decision:** Use React 18.3.1 as the compatibility target unless all legacy UI packages and panels demonstrate React 19 support.

**Reason:** The application already uses React's modern `createRoot` API. React 18.3 is a supported migration bridge and avoids a broad behavioral rewrite across older drag/drop, upload, form, router, and widget packages.

## F-004 — Prefer Vite 7 over Vite 8

**Decision:** Target the latest compatible Vite 7 release with Laravel Vite plugin 2.x and React plugin 5.x.

**Reason:** Vite 7 is outside the audited vulnerable ranges, supports the available Node 24 runtime, and avoids Vite 8's newer Rolldown/compiler-plugin requirements while still providing a current supported toolchain.

## F-005 — Commit the npm lockfile

**Decision:** Remove `package-lock.json` from `.gitignore` and commit the verified lockfile.

**Reason:** The repository previously ignored its lockfile even though reproducible `npm ci` and dependency-cached CI require it. The committed lock resolves the historical React ApexCharts peer conflict without `--legacy-peer-deps`.

## F-006 — Pin the compatible React ApexCharts wrapper

**Decision:** Keep ApexCharts on the existing 3.x line and pin `react-apexcharts` to `1.4.1`.

**Reason:** Later releases admitted by the old loose range require ApexCharts 4 or newer. Pinning the last compatible wrapper preserves chart behavior while making dependency installation deterministic.

## F-007 — Verify bundle contracts instead of rewriting entries

**Decision:** Add a manifest assertion for all 12 client entries and compile the existing Inertia SSR entry in CI.

**Reason:** The application has multiple independent Blade and panel entry points. Explicit contract verification detects accidental bundle loss with less behavioral risk than consolidating or restructuring the frontend.

## F-008 — Remove only dependencies proven unused

**Decision:** Remove obsolete build plugins and UI packages only after confirming they have no active source imports; otherwise retain application dependencies even when newer majors exist.

**Reason:** The goal is a secure, supported build path while preserving business behavior. Broad package churn without coverage would increase regression risk.

