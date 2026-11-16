# Private staging architecture

The staging Compose project is independent of Sail and `landatrip-e2e`. A single public edge, Caddy, obtains HTTPS certificates and requires HTTP Basic credentials. It routes to private Nginx, which serves static Vite assets and forwards PHP to PHP-FPM. A private MySQL 8 volume holds only staging data. A separate container runs Laravel's scheduler. The Inertia SSR bundle is built, but SSR is disabled in staging: the current application has no active Inertia render routes and its bundle contains browser-only dependencies. The queue uses the `sync` driver; add a worker only after a queued workload and backend are approved. Persistent storage is a named volume shared read-only with Nginx. All service ports except Caddy are unbound on the host. The Compose network marked `internal` keeps the app and database off public interfaces; Caddy also joins a second outbound network for ACME.

```text
Internet -> Caddy (TLS + Basic auth) -> Nginx -> PHP-FPM -> MySQL
                                   -> static files / storage
                      scheduler -> PHP image + MySQL
```

The PHP image uses Debian Trixie PHP 8.4 FPM and required extensions. A Node 22 builder runs `npm ci`, Vite client and SSR builds, and manifest validation. Composer installs from `composer.lock` with development packages omitted. Image build arguments contain only the public staging URL; secrets enter at container runtime. Images are tagged with the source commit's 12-character SHA by the deploy script. Caddy, MySQL, storage and all app containers have restart policies and memory caps. Budget roughly 2 vCPU, 4 GiB RAM, and 20 GiB disk including backups and image layers. A small existing Linux VPS with Docker Engine, Compose v2, and ports 80/443 available is sufficient. Reserve additional disk for media and backups.

The included Caddy edge needs exclusive host ports 80/443. On a server with an existing reverse proxy, bind Caddy to alternate loopback ports and configure the existing proxy for TLS and access protection; preserve the X-Forwarded headers. Do not edit live virtual hosts without a separate deployment plan. The local override binds `127.0.0.1:8443` only.
