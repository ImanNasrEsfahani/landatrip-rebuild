# Frontend modernization: React 18 and Vite 7

## Summary

This pull request modernizes the LandaTrip frontend build and React integration on top of the merged Laravel 13 baseline at `01af613`. It preserves the current UI, routes, API contracts, stylesheets, and the admin, manager, teacher, agent, and user panels. PHP, Laravel, database versions, Tailwind's major version, and backend business logic are unchanged.

## Checkpoints

1. **Build baseline:** fixed the pre-existing Linux case-sensitive imports for `Tour.tsx` in the teacher and user panels and `paypal.svg` in the booking flow, then verified the historical Vite 4 production build.
2. **Reproducible install:** committed `package-lock.json`, resolved the React ApexCharts peer conflict, removed unused build packages, and restored plain `npm ci` without compatibility flags.
3. **Reproducible route contracts:** committed all six Laravel-generated React route manifests after verifying that regeneration produced byte-for-byte identical output.
4. **Supported toolchain:** upgraded to Vite 7.3.8, Laravel Vite plugin 2.1.0, and React Vite plugin 5.2.0 while preserving all client and SSR entries.
5. **React integration:** standardized React and React DOM on 18.3.1, upgraded Inertia React to 2.3.29 and React Router DOM to 7.18.5, and retained React 18 for compatibility with legacy UI packages.
6. **Automated verification:** added a 12-entry Vite manifest contract check, explicit Inertia SSR build, dependency audit, and Node 22 GitHub Actions job.

## Verification

- `npm ci` — passed without flags.
- `npm audit --audit-level=high` — passed; full audit reports 0 known vulnerabilities across 447 dependencies.
- `npm run test:frontend` — passed: client production build, 12 expected manifest entries, all five application panels, and Inertia SSR build.
- Laravel integration suite — 21 tests passed, 73 assertions, including public routes, panel auth redirects, mobile API v1, and Sanctum.

## Deployment requirements

- Node.js `^20.19.0` or `>=22.12.0`; CI uses Node 22.12.0.
- Run `npm ci` from the committed lockfile.
- Run `npm run test:frontend` before deployment.
- After any Laravel route change, run `php artisan generate:react-routes` and commit the regenerated frontend contracts.
- Deploy the generated client assets from `public/build`; deployments using Inertia SSR must also deploy and start the generated `bootstrap/ssr/ssr.mjs` using the existing Laravel SSR process.
- Existing PHP 8.4 / Laravel 13 and database requirements are unchanged.

## Remaining limitations

- React 19, Tailwind 4, Vite 8, and MySQL upgrades are intentionally excluded.
- Large teacher and user panel chunks remain a performance optimization opportunity.
- Sass `@import` deprecations remain source-level technical debt.
- There is no component-level JavaScript test suite; authenticated UI flows and third-party booking, payment, upload, and broadcasting integrations still require staging smoke testing with non-production credentials.

This pull request should remain open and unmerged for review.
