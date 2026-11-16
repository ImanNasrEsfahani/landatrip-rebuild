# Frontend Modernization

Last updated: 2026-11-15

## Scope

Modernize the existing React, Vite, Laravel Vite plugin, Inertia adapter, and compatible frontend dependencies while preserving the current UI, routes, layouts, forms, API contracts, and all five application panels. PHP, Laravel 13, MySQL, Tailwind, and backend behavior remain unchanged unless a frontend compatibility fix requires a narrowly scoped edit.

## Starting point

- Base branch / commit: `main` / `01af613`
- Working branch: `feature/frontend-modernization`
- Node: `24.22.1`
- npm: `11.9.0`
- Lockfile format: 3
- React / React DOM installed: `18.3.1`
- Vite installed: `4.5.14`
- Laravel Vite plugin installed: `0.7.8`
- React Vite plugin installed: `3.1.0`
- Inertia React installed: `1.3.0`
- Tailwind installed: `3.4.19`

## Baseline checkpoint

- Fixed Linux case-sensitive imports from `tours/tour` to the tracked `Tour.tsx` in both teacher and user panels.
- Fixed the booking payment asset import from `payPal.svg` to the tracked `paypal.svg`.
- Verified a complete production build across the public UI and admin, manager, teacher, agent, and user panel entry points.
- The historical lock requires `npm ci --legacy-peer-deps` because its loose `react-apexcharts` range resolved to 1.9.0 while ApexCharts remains 3.54.1. Modernization must restore plain `npm ci` rather than retaining this workaround.
- Baseline `npm audit --package-lock-only` reports 17 vulnerabilities: 1 high, 13 moderate, and 3 low. The high-severity findings are in the old Vite toolchain.

## Planned checkpoints

1. Reproducible dependency graph: resolve peer conflicts and make plain `npm ci` pass.
2. Build toolchain: move to a supported Vite line with matching Laravel and React plugins; retain every existing entry point.
3. React integration: retain React 18.3 for ecosystem compatibility, update Inertia React to the server adapter's 2.x line, and update compatible runtime dependencies without forcing React 19.
4. Verification and delivery: production build, audit, backend integration suite, frontend CI, exact version documentation, and a PR to `main`.

## Current warnings and risks

- Sass reports deprecated legacy API and `@import` usage. Migrating the large stylesheet graph is deferred unless required by the selected supported Sass/Vite line.
- Teacher and user panel output chunks exceed 500 kB. Code splitting is a performance follow-up, not a correctness change.
- The legacy Rollup inject plugin attempts to parse SCSS and emits a warning; its scope should be limited to JavaScript during the toolchain upgrade.
- Several older UI libraries have restrictive or stale peer dependencies. Upgrades will be selected by compatibility and verified builds rather than newest-version adoption alone.

