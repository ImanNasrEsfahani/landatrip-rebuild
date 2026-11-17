# Phase 7B: capacity decision and existing `.ca` 503

This follows the Phase 7A read-only audit. The administrator supplied Docker, Apache, memory, and socket output. A further nonprivileged SSH inspection read only Apache directives, the existing `.ca` source files, process RSS, and Azure instance metadata. No production service or infrastructure setting was changed.

## Evidence and 503 classification

The enabled `landatripca.conf` has **both** `*:80` and `*:443` virtual hosts for `landatrip.ca` and `www.landatrip.ca`. Both use `ProxyPass / http://localhost:5001/`, with no HTTP-to-HTTPS redirect. The existing `/var/www/landatripca/static-pages/docker-compose.yml` defines a `nextjs-service` with `container_name: static-pages` and `5001:5001`; its Dockerfile exposes 5001 and starts `npm start`; its package script runs `next start -p 5001`. The files and Apache virtual host date from 2025-08-22. This establishes the original reason for port 5001: it was the Next.js static-pages upstream.

At the administrator's snapshot, `docker ps` showed only the three NovaNest containers. `ss -ltnp` had no port 5001 listener, and `curl http://127.0.0.1:5001/` failed with connection refused. Phase 7A observed HTTP 503 from Apache. The administrator then ran `docker ps -a --filter name=static-pages`, which returned no matching container, and `docker inspect static-pages`, which returned `no such object`. **The immediate cause of the 503 is that Apache's configured upstream has no listener, and the named `static-pages` container is absent rather than stopped.** Available records do not establish whether the container was removed accidentally, its proxy target was deliberately retired, or it was never created under that name. No readable systemd unit references port 5001 or `static-pages`. The old source repository has only an initial 2025 commit and currently contains uncommitted edits, including untracked Dockerfile and Compose files. These facts do not establish a safe artifact to restart or rebuild. Deployment ownership and history remain the cause-classification gap.

Read-only administrator commands already completed (no container matched; inspect returned `no such object`):

```sh
sudo docker ps -a --filter name=static-pages --format 'table {{.Names}}\t{{.Image}}\t{{.Status}}\t{{.Ports}}'
sudo docker inspect static-pages --format 'status={{.State.Status}} exit={{.State.ExitCode}} finished={{.State.FinishedAt}} restart={{.HostConfig.RestartPolicy.Name}}'
```

The site owner should consult the site's deployment record, retained images, backups, and change history before deciding whether port 5001 is obsolete or how to restore it. Do not rebuild from the uncommitted worktree without a reviewed source snapshot and application owner approval.

## Current resource snapshot

The administrator's `docker stats --no-stream` measured the running containers below. These are container memory readings at one instant, not guaranteed peaks.

| Running container | Memory used |
| --- | ---: |
| NovaNest backend | 18.82 MiB |
| NovaNest frontend | 63.32 MiB |
| NovaNest MySQL 8 | 39.18 MiB |
| **NovaNest total** | **121.32 MiB** |

At the administrator's snapshot, `free -h` showed 952 MiB physical RAM, 565 MiB used, 288 MiB available, and 944 MiB swap used. A following nonprivileged snapshot showed 564 MiB used and 289 MiB available. Process RSS at that second was: Docker daemon 173.6 MiB, containerd 37.6 MiB, Apache parent plus four workers 39.5 MiB combined, system journal 36.0 MiB, Tailscale 27.2 MiB, host MariaDB 3.2 MiB, and Webmin 3.9 MiB. Host MariaDB listens on `127.0.0.1:3306`; it is distinct from the NovaNest MySQL 8 container. Process RSS includes shared pages and may overlap the Docker container readings, so these numbers must not be added to claim exact unique RAM consumption. The `.ca` Next.js service is not running, so its operating memory is currently zero and its future demand is unmeasured. Docker uses 9.755 GB for images and 1.6 GB for build cache; these are disk figures, not RAM use. Phase 7A found 33 GB free on the root filesystem.

The Phase 6 LandaTrip caps allow 768 MiB MySQL, 768 MiB PHP-FPM, 256 MiB scheduler, and 128 MiB Nginx (1,920 MiB total). Plausible additional operating use is 0.8–1.4 GiB and peak use 1.6–2.0 GiB, before recovery of the old Next.js site and a safety reserve. The existing 944 MiB of swapped pages is a warning, not available RAM. Budget a further 1 GiB of free headroom for concurrent NovaNest, Apache, the old site, and traffic spikes. The measured 565 MiB used plus a 2 GiB LandaTrip peak, an unmeasured old-site allowance, and 1 GiB headroom already approaches 4 GiB; possible swap refaults make that size too tight. **Do not run LandaTrip on the current 1 GiB VM or recreate the old `.ca` container merely to test it.** Plan at least 6 GiB RAM for the shared host; the practical same-family Azure target is **8 GiB RAM with at least 2 ARM64 vCPUs**, using off-host image builds. Preserve at least 20 GiB disk free for deployment artifacts and database growth, plus separate backup capacity. Validate actual peaks after an approved upgrade before any cutover. A separate staging VM can start at 4 GiB RAM if it runs only the isolated LandaTrip stack, with 8 GiB preferred for more traffic or concurrent testing.

## Azure options and service continuity

Read-only Azure instance metadata identifies the current `westus2` VM as `Standard_B2pts_v2` (ARM64, 2 vCPUs, 1 GiB). In the same burstable ARM series, `Standard_B2pls_v2` provides 2 vCPUs and 4 GiB, while `Standard_B2ps_v2` provides 2 vCPUs and 8 GiB. The 8 GiB size is the shared-host memory candidate; the 4 GiB size is marginal for simultaneous legacy-site recovery and a new stack. [Microsoft's Bpsv2 specifications](https://learn.microsoft.com/en-us/azure/virtual-machines/sizes/general-purpose/bpsv2-series) confirm those sizes and their CPU credit model. B-series CPU credits must also be checked against sustained Apache, NovaNest, and LandaTrip load; a non-burstable 2-vCPU/8-GiB ARM size such as [`Standard_D2ps_v6`](https://learn.microsoft.com/en-us/azure/virtual-machines/sizes/general-purpose/dpsv6-series) is an alternative for sustained demand. Confirm size availability, quota, disk compatibility, and exact price in the Azure subscription before an approval decision. These are candidates, not a resize instruction.

An in-place resize changes the existing VM's ongoing compute cost and restarts it, interrupting Apache and all hosted applications. It may require deallocation if the size is unavailable on the current cluster; deallocation can release a dynamic public IP, as described in [Microsoft's VM resize guidance](https://learn.microsoft.com/en-us/azure/virtual-machines/sizes/resize-vm). Verify that the production IP is static and take an approved backup/snapshot and rollback plan before scheduling any such operation. A separate staging VM adds another VM, disk, and potentially network charges but allows isolated build validation and staging traffic without restarting NovaNest or the existing Apache host. The latter is the lower-risk path for private testing; it does not itself repair the `.ca` 503. No resize or new VM was performed.

After an approved increase to adequate shared-host RAM, off-host image pulls and a loopback-only LandaTrip stack at `127.0.0.1:18080` can be prepared while NovaNest, Apache, and a recovered port-5001 site remain online. The Apache cutover still requires a controlled change and may briefly interrupt `.ca` requests. On the current VM, this concurrent operation is not safe.

## Non-destructive `.ca` recovery plan

1. The named `static-pages` container is absent. Have the `.ca` site owner identify its last known deployment artifact, removal or retirement decision, and backup from administrative deployment records. Do not assume the uncommitted source worktree is a reproducible replacement.
2. Preserve the present Apache virtual-host file, `.ca` source and its uncommitted edits, retained images, and any site data. Confirm backup and rollback ownership. The old Compose file publishes `5001:5001` on all host interfaces, so review access controls or a loopback-only replacement before any approved recreation.
3. After sufficient RAM and a separately approved recovery action, validate the old site on port 5001, then its existing HTTP and HTTPS routes. If the old artifact cannot be recovered, prepare a separately approved maintenance response or legacy-site restoration plan. Keep the new LandaTrip deployment decision independent of this repair.

## Equivalent Apache staging access gate (proposal only)

The Phase 6 Caddy edge requires HTTP Basic credentials before Laravel receives any request, including `/healthz` and API calls. Removing Caddy in the Apache overlay must preserve that gate. The existing `.ca` Apache virtual hosts do **not** have Basic authentication. Apache's `auth_basic`, `authn_file`, `authz_user`, `headers`, `proxy`, `proxy_http`, `rewrite`, and `ssl` modules are enabled, but no new virtual-host configuration has been applied. For an explicitly approved private `.ca` cutover, the administrator can adapt this HTTPS-only proposal inside its `*:443` virtual host, using an administrator-owned password file outside the document root:

```apache
<Location "/">
    AuthType Basic
    AuthName "LandaTrip private staging"
    AuthBasicProvider file
    AuthUserFile /etc/apache2/landatrip-staging.htpasswd
    Require valid-user
</Location>

# The Basic header authenticates at Apache. Forward only a separate API bearer
# header to Laravel, after Apache authentication has completed.
RequestHeader unset Authorization
RequestHeader set Authorization "expr=%{req:X-Staging-Api-Authorization}"
RequestHeader unset X-Staging-Api-Authorization
```

Apache normally applies `RequestHeader` in the fixup phase after authentication, as documented by [mod_headers](https://httpd.apache.org/docs/2.4/en/mod/mod_headers.html); the Basic access pattern is documented by [Apache authentication guidance](https://httpd.apache.org/docs/2.4/en/howto/auth.html). API clients would send Basic credentials in `Authorization` and a Laravel bearer token in `X-Staging-Api-Authorization`, matching Phase 6's Caddy contract. Browser clients use Basic credentials plus Laravel's secure session cookie. The administrator must validate syntax and header behavior in an isolated test before a cutover. Required checks include unauthenticated 401 even for `/healthz`, authenticated health and login, rejected invalid Basic credentials, bearer API authentication with both headers, no Basic credential forwarded to Laravel, protected assets, secure cookies, checkout HTTP 409, and inaccessible synthetic E2E payment routes. Use unique credentials and do not log them. A future HTTP virtual-host change should redirect to the validated HTTPS `.ca` origin, initially with a temporary redirect and only later a permanent one if clients behave correctly. No redirect exists today, and leaving its proxy to 5001 would leave HTTP broken.

`landatrip.ca` is the sole deployment target. The enabled `landatrip.com` virtual host is retired and must not be treated as an active deployment destination. Connecting the public `.ca` virtual host to 18080, adding the access gate, and redirecting HTTP are all one separately approved cutover; until then, keep the new stack loopback-only and test it privately without changing Apache.

## Gate for a later private Apache deployment

No deployment is authorized by this document. The administrator and application owner must approve:

1. The recovery or intentional-retirement plan for the absent legacy `static-pages` container, including who owns the present 503 and what historical artifact can be trusted.
2. An 8 GiB shared-host resize and maintenance window **or** a separately priced 4 GiB-or-larger ARM64 staging VM; confirm Azure quota, size availability, CPU credits, public IP type, backups, and a rollback plan. Neither option is approved or provisioned here.
3. A private access policy. The Apache Compose overlay omits Caddy Basic auth, and the existing Apache `.ca` virtual hosts have no access gate. Review the Apache Basic and API-header proposal above, its credentials, tests, and rollback before connecting Apache to 18080. Loopback binding alone does not make a public Apache route private.
4. Off-host ARM64 image publication from reviewed code, recorded PHP/Nginx/MySQL image digests, `linux/arm64` manifest checks, registry pull credentials, and an overlay configuration with no `build` entries or public PHP/MySQL ports. Do not use the Phase 6 `staging-deploy.sh` on the shared server because it builds and migrates there.
5. Isolated LandaTrip database and storage, no customer-data copy, tested backups and restore, migration review on disposable data, and a documented application/image/schema rollback path.
6. A precise change for **both** `.ca` Apache virtual hosts, trusted forwarded headers, TLS and cookie settings, a saved old configuration, health/auth/asset checks, checkout HTTP 409, inaccessible synthetic E2E payment routes, and an approved maintenance/rollback window. Apache must not point to 18080 until the private stack passes loopback checks.

PR #8 is a preparation PR, not a production deployment authorization. Its five CI checks passed, including an off-host ARM64 build. No published application image digest exists from that pull-request run; publication and immutable deployment verification remain later gates.
