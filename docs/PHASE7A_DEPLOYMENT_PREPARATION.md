# Phase 7A: shared host audit and deployment preparation

Audit date: 2026-11-17 UTC. This is a read-only assessment. No deployment, migration, service restart, DNS, certificate, or Apache change was made.

## Server findings and decision

The pinned-host-key SSH connection as `codexdeploy` succeeded through the established HTTP CONNECT proxy. The host is ARM64 (`aarch64`), 2 vCPUs, with 952 MiB RAM, 2 GiB swap (about 999 MiB already used), and 33 GiB free on `/`. At observation, `MemAvailable` was 386 MiB and load averages were 0.00, 0.02, 0.02. Apache2, Docker 29.1.3, Compose 2.40.3, MySQL, and NovaNest processes were present. `codexdeploy` cannot access `/var/run/docker.sock`, so exact container memory use and running container details remain unverified. Do not grant Docker access just for this audit.

Apache has enabled virtual hosts for `landatrip.ca`, `landatrip.com`, and NovaNest. Both HTTP and HTTPS for `landatrip.ca` currently proxy to `localhost:5001`, but that port refused a local connection and local HTTPS returned 503. Treat the `.ca` virtual host and content as existing live infrastructure; its present failure is not permission to replace it. Ports 80 and 443 are held by Apache. Ports 3001, 8001, and 10000 are listening on all interfaces; MySQL 3306 is loopback only. Port 18080 was unbound at observation. The `.ca` name resolved to 20.51.124.83 from the host; `www` resolved to Cloudflare addresses. The existing `.com` Laravel tree and `.ca` static pages tree were visible under `/var/www`. No application secrets were read.

**Deployment is blocked on the current VM.** The existing 386 MiB available physical memory is less than a reasonable MySQL 8 instance alone under load, and swap already holds about 1 GiB. The Phase 6 caps permit up to 768 MiB MySQL, 768 MiB PHP-FPM, 256 MiB scheduler, and 128 MiB Nginx: 1,920 MiB in addition to Apache, Docker, NovaNest, the existing MySQL and OS. These caps are ceilings, not a measurement. Estimate steady additional use around 0.8–1.4 GiB and peaks around 1.6–2.0 GiB, plus existing workload variation. An on-host Node/Composer image build can require multiple additional GiB and is excluded. Swap cannot provide the latency or headroom required for safe service operation.

| Approach | Assessment |
| --- | --- |
| Existing VM unchanged | Blocked by physical memory and existing swap use. |
| Existing VM after approved RAM upgrade | At least 4 GiB total RAM; target 6 GiB for shared production workloads, subject to administrator container measurements and load testing. Keep disk reserve for images, database, media, and backups. |
| Off-host ARM64 images, minimal on-host pull | Required even after a RAM upgrade. Pull reviewed image digests; never build on the shared host. It does not fix the current RAM shortage. |
| Separate staging environment | Preferred if a production VM upgrade or `.ca` cutover is unsuitable. Budget at least 4 GiB RAM and 20 GiB disk plus backups. No environment has been provisioned. |

## ARM64 and immutable images

The Phase 6 Dockerfile uses Node 22 Bookworm, Debian Trixie with PHP 8.4 packages, and Nginx Alpine. Their published base manifests include `linux/arm64`; MySQL `8.0` also publishes ARM64. The npm lockfile includes ARM64 `esbuild` and Rollup packages. Required PHP packages include FPM, CLI, bcmath, curl, gd, HTTP/raphf, intl, mbstring, mysql, xml, and zip. Package availability and the full application build on ARM64 must still pass the new off-host CI job; base manifests alone are not proof. The same PHP image runs FPM and the scheduler. SSR remains disabled at runtime as in Phase 6.

The new workflow builds on an ARM64 GitHub runner for pull requests, without publishing. A manual run on reviewed `main` publishes commit-tagged PHP and Nginx images to GHCR and checks their ARM64 manifests. Record each resulting digest and verify the digest's `linux/arm64` manifest before any deployment. Pin the MySQL 8 ARM64 digest too. `compose.apache.yml` uses only those digest references, clears the local build definitions, omits Caddy, and binds Nginx to `127.0.0.1:18080`. Do not use `scripts/staging-deploy.sh` for this topology: it builds, starts containers, and migrates on-host.

## Apache proposal (administrator review only)

After memory, image, backup, application, and cutover approval, an administrator can adapt the existing `landatrip.ca` HTTPS virtual host by preserving its TLS certificate and replacing only its current upstream with the following directives. First identify why port 5001 is down and decide whether the old site needs restoration. Preserve the current virtual-host file and a rollback copy before any change.

```apache
ProxyPreserveHost On
ProxyAddHeaders On
RequestHeader unset X-Forwarded-For
RequestHeader unset X-Forwarded-Host
RequestHeader set X-Forwarded-Proto "https"
RequestHeader set X-Forwarded-Port "443"
ProxyPass / http://127.0.0.1:18080/
ProxyPassReverse / http://127.0.0.1:18080/
```

Keep the existing HTTP-to-HTTPS behavior, SSL settings, other virtual hosts, and DNS untouched. Confirm `mod_proxy`, `mod_proxy_http`, and `mod_headers` are enabled before planning a change. Apache must overwrite client-supplied forwarded headers; Nginx forwards the resulting scheme and host to PHP-FPM. Keep PHP-FPM and MySQL on the Compose internal network with no published port. Set `APP_URL=https://landatrip.ca`, `SESSION_SECURE_COOKIE=true`, `SESSION_SAME_SITE=lax`, the matching Sanctum stateful domain and CORS origin, and `TRUSTED_PROXIES` to the private Nginx proxy address or the narrowest reviewed private network range. Do not use a wildcard proxy trust for a publicly reachable upstream. Verify cookie Secure attributes, CSRF/login/logout, API auth, asset URLs, and redirects through HTTPS before cutover.

## Deployment gate and rollback

Do not deploy under this phase. Before a later approved deployment, the administrator should inventory Docker containers and memory, confirm sufficient RAM under NovaNest and existing Apache load, resolve the current `.ca` 503, verify registry access, image digests, port 18080, and backup capacity. Create a fresh, separate LandaTrip MySQL volume; do not import production customer data. Review any migration against a disposable copy with synthetic data. The commercial checkout gate must continue to return HTTP 409, and synthetic E2E payment routes must remain inaccessible. Keep provider credentials absent until independently approved.

For rollback planning, retain the previous Apache virtual-host file and an application/image digest record. Back up the new database and storage before any future migration, restore into a disposable target for validation, and arrange a controlled cutover. Switching image digests cannot reverse a schema migration. At the cutover, test `/healthz`, pages, assets, auth, and checkout gating before changing Apache; if they fail after the switch, restore the old upstream and reload Apache through the administrator's planned change procedure. Do not remove volumes or run destructive migrations.

## Read-only commands for an administrator

The unprivileged SSH account could not query Docker. An administrator can run these exact read-only commands and provide redacted outputs before approving capacity or cutover:

```sh
sudo docker ps --format 'table {{.Names}}\t{{.Image}}\t{{.Status}}\t{{.Ports}}'
sudo docker stats --no-stream --format 'table {{.Name}}\t{{.MemUsage}}\t{{.CPUPerc}}'
sudo docker system df
sudo apache2ctl -S
sudo apache2ctl -M
sudo ss -ltnp
```

Do not include environment variables, container inspection output, database contents, private keys, or application `.env` files in the shared results.
