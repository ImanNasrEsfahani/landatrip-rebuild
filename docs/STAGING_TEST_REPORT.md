# Private staging test report

Validated on 2026-11-16 from `feature/private-staging-deployment`, based on `origin/main` commit `7713999a`. GitHub PRs #1 through #6 are present, including PR #6 commits `102b89d3` and `cd5c1e88`. The clean staging deployment used detached commit `f466f05656fd02699db732d2faa48917ee8e9570` in a separate worktree. Its tracked tree remained clean after configuration, deployment, seeding, and smoke testing.

| Gate | Result |
|---|---|
| Staging Compose validation and PHP/Nginx image build | Passed from clean checkout; images tagged with commit SHA |
| PHP 8.4 platform requirements | Passed (`composer check-platform-reqs --no-dev`) |
| Vite client build and manifest | Passed; all 12 entries, including five panels, verified |
| Inertia SSR bundle build | Passed; intentionally disabled at runtime because there are no active Inertia render routes and the current bundle contains browser-only dependencies |
| MySQL 8 staging migrations | 102 forward migrations passed on a fresh, separate database; no destructive command was used on staging |
| Financial migration | PR #6 migration adds nullable exact fields and does not alter legacy money columns; all six legacy money columns remain `DOUBLE` in the clean staging database. The PR #6 pre-merge audit in `PHASE5_TEST_CHECKOUT.md` separately verified before/after checksums for fractional and out-of-range historical values. |
| Synthetic staging seeder | Passed on staging; refused the E2E database even with an explicit seed flag |
| Protected staging Chromium | 12/12 passed from clean checkout: desktop and mobile public pages, tour detail, assets, login/logout for five panels, API role boundaries, HTTP 409 checkout gate, and fixture route absence |
| Disposable E2E Chromium | 12/12 passed with separate `landatrip_e2e` MySQL and local-only fake checkout |
| Laravel tests | 38 passed, 1 existing skip, 191 assertions on a freshly reset disposable E2E database |
| npm security audit | 0 vulnerabilities at all severities |
| Composer security audit | Inconclusive locally: the network proxy returned HTTP 403 for Packagist's advisory endpoint; backend PR CI runs this gate |

Authenticated `https://localhost:8443/healthz` and home returned 200, anonymous health returned 401. All staging containers, including the scheduler, remained running; MySQL was not bound to a host port. The clean local URL is loopback only and is not a remote preview. No real payment or external booking was attempted. Commercial checkout remained HTTP 409, and staging contained no E2E fixture routes.

Known limitations: no external staging host or DNS has been supplied; a real browser-accessible URL and certificate therefore remain unverified. Route caching fails on pre-existing duplicate route names, so deployment caches configuration and Blade views only. SSR is built but disabled as noted above. Mail is logged, and third-party integrations were not activated. GitHub CI status is tracked on the pull request rather than asserted here before it runs.
