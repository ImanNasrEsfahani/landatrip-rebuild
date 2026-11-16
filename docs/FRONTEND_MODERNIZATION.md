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

## Verified modernization checkpoint

The dependency graph is now reproducible with a committed lockfile and plain `npm ci`; no legacy peer-dependency override is required. The verified direct versions are:

| Package | Version |
| --- | ---: |
| Node.js used locally | `24.22.1` |
| Node.js used by CI | `22.12.0` |
| npm used locally | `11.9.0` |
| Vite | `7.3.8` |
| Laravel Vite plugin | `2.1.0` |
| React Vite plugin | `5.2.0` |
| React / React DOM | `18.3.1` |
| Inertia React | `2.3.29` |
| React Router DOM | `7.18.5` |
| ApexCharts / React ApexCharts | `3.54.1` / `1.4.1` |
| Sass | `1.108.2` |
| Tailwind CSS | `3.4.19` |
| PostCSS / Autoprefixer | `8.5.33` / `10.6.2` |
| daisyUI | `3.9.4` |

The following unused or obsolete packages were removed after source searches confirmed no active imports: the old Laravel PurgeCSS plugin, React Hook Form devtools, Sass variables loader, deprecated React refresh plugin, React simple widgets, RTL CSS, the `scss` compatibility package, and `tw-elements-react`. The jQuery Rollup injection is limited to JavaScript and TypeScript sources so it no longer attempts to parse SCSS.

## Verification evidence

- `npm ci`: passes from the committed lockfile without flags.
- `npm audit --audit-level=high`: passes; the full audit reports 0 vulnerabilities across 447 dependencies.
- `npm run test:frontend`: builds all production client bundles, validates all 12 manifest entries, and builds the Inertia SSR bundle.
- Client manifest verification includes the admin, manager, teacher, agent, and user panels.
- All six Laravel-generated React route manifests are committed; regenerating them with `php artisan generate:react-routes` produced byte-for-byte identical files before commit.
- SSR output is generated as `bootstrap/ssr/ssr.mjs` with its SSR manifest.
- Laravel 13 regression suite: 21 tests passed with 73 assertions using the prepared isolated SQLite fixture.
- CI: `.github/workflows/frontend-ci.yml` runs Node 22.12, locked installation, security audit, client build, manifest contract verification, and SSR build on pull requests to `main`.
- GitHub Actions on PR #2: the frontend Node 22 job and the existing Laravel 13 / PHP 8.4 / MySQL 8 job both passed after the clean-checkout route contract fix.

## Remaining risks and follow-up

- React 19 is intentionally deferred. Several legacy UI, upload, drag-and-drop, and form packages need dedicated behavioral testing before changing React's runtime major.
- Tailwind remains on 3.4.19; a Tailwind major upgrade was explicitly out of scope.
- The Sass source graph still relies on deprecated `@import` patterns. It remains buildable, but should be migrated separately before a future Sass removal deadline.
- Teacher and user panel output chunks exceed 500 kB. Code splitting is a performance follow-up, not a correctness regression.
- The repository has no component-level JavaScript test suite. Builds, entry-point contracts, SSR compilation, and Laravel integration tests are automated; manual browser smoke testing of authenticated workflows is still recommended before production deployment.
- Payment, booking, uploads, WebSocket broadcasting, and third-party integrations require staging credentials and were not exercised against live services.
- When Laravel routes change, run `php artisan generate:react-routes` and commit the resulting six frontend route manifests so clean builds and CI receive the same contracts.

