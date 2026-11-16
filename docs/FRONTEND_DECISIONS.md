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

