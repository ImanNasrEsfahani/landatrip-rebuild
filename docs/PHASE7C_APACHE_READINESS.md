# Phase 7C: reviewable Apache cutover preparation

`landatrip.ca` is the only target. `landatrip.com` is retired. This document prepares a future change; it does not authorize an Azure resize, server deployment, database migration, Apache reload, DNS or certificate change, or deletion of legacy files.

## Isolated Apache validation

`deploy/apache/landatrip.ca.conf.template` is the proposed pair of HTTP and HTTPS virtual hosts. The isolated test renders that same template with local ports, a one-day local certificate, a generated Basic password file, a disposable header probe, and the Phase 6 synthetic staging stack. The header probe exists only in the test render. The HTTP virtual host returns a temporary 302 to HTTPS, preserving path and query. The HTTPS virtual host requires Basic authentication before every upstream route. Apache removes the Basic `Authorization` header after authenticating, replaces it with `X-Staging-Api-Authorization` for Laravel API calls, and strips that custom header. It overwrites client-supplied forwarded protocol and port headers.

The repository-side test runs on a disposable Compose project and is repeated by `.github/workflows/apache-integration.yml` on a GitHub runner. It checks Apache syntax, 401 without Basic (including `/healthz`, assets, and the probe), invalid Basic rejection, bearer forwarding, Basic credential stripping, HTTP 302, secure SameSite cookies, CSRF, assets, browser sign-in/out, all five panels' role boundaries, checkout HTTP 409, and absent synthetic payment callbacks. The test runner's local Apache ports are `127.0.0.1:18081` and `127.0.0.1:18443`; these are unrelated to the production server.

The future administrator must still validate the **rendered production** Apache file with `apache2ctl -t` before any approved reload. The existing host already listens on 80 and 443, so the template's test-only `Listen` marker remains a comment in production. Production placeholders are: HTTP port `80`, HTTPS port `443`, server name `landatrip.ca`, HTTPS origin `https://landatrip.ca`, existing certificate and key paths, an administrator-owned Basic password file outside the document root, forwarded HTTPS port `443`, and upstream `http://127.0.0.1:18080`. Keep the existing `www.landatrip.ca` alias. The `# TEST_PROBE_PROXY` marker remains a comment; never expose the test probe. Protect the password file so only Apache's service user and administrators can read it. Confirm authenticated API clients send Basic credentials plus the separate `X-Staging-Api-Authorization: Bearer ...` header. Do not log either credential.

The redirect is 302 for the first approved cutover so clients do not cache a permanent redirect during rollback. Only consider 301 after HTTPS, host aliases, cookies, and client behavior have been verified. No live virtual host was changed for this test.

## Non-destructive legacy backup and retirement sequence

Before any future cutover, an administrator and the `.ca` site owner must choose a secure backup location outside `/var/www` with enough capacity and access restricted to administrators. **Prepare, do not execute in this phase:**

1. Record the current `/etc/apache2/sites-available/landatripca.conf` bytes, ownership, permissions, and SHA-256 hash; record enabled-site links and `apache2ctl -S`. Copy the complete virtual-host file into the protected backup set. Keep the current Cloudflare certificate and key in their original managed location; capture their paths and backup policy, never paste private-key contents into a PR.
2. Archive `/var/www/landatripca` including `.git`, tracked edits, untracked `Dockerfile`, `docker-compose.yml`, and `src/components`, ownership, permissions, timestamps, and extended attributes. The old tree is not a clean commit. Capture `git status --porcelain=v1`, `git diff --binary`, and the untracked-file list into the same protected set. Do not run `git clean`, reset the worktree, or discard files. Avoid copying production customer data into a test environment.
3. Record the absent `static-pages` container finding, any retained old image digest and deployment record, and the contents of `/var/www/landatripca` without assuming a reconstructable container. Hash the backup archive, test listing and a disposable restore, and record the location, retention period, and owner. Do not place backups or credentials in Git or a web-served directory.
4. Establish a **working fallback** before retirement. Restoring only the old Apache configuration would still return 503 while port 5001 has no listener. The site owner must approve either a verified legacy-service recovery or a reviewed maintenance response as the rollback destination.
5. Only after the new site has passed a separately approved cutover and soak period should the owner decide whether to retire the old source and backup artifacts. Deletion requires its own explicit approval and retention decision.

## Off-host image publication and digest checks

Pull-request builds validate ARM64 without publishing. After a reviewed, manually merged commit reaches `main`, a **separately approved** manual run of `arm64-images.yml` on `main` publishes PHP and Nginx images to GHCR. The workflow validates the manifest at each output digest and writes the exact digest references to its run summary. This does not build on the Azure VM.

For each published PHP and Nginx digest, and the selected MySQL 8 digest, the release reviewer should independently run the following **off-host** command using the exact `name@sha256:...` reference recorded in the change ticket:

```sh
docker buildx imagetools inspect --raw 'IMAGE_NAME@sha256:FULL_DIGEST' |
  jq -e 'if .manifests then any(.manifests[]; .platform.os == "linux" and .platform.architecture == "arm64") else .os == "linux" and .architecture == "arm64" end'
```

Record the reviewed merge SHA, workflow run URL, all three digest references, and the manifest check results. The digest values belong in protected deployment configuration; repository examples must never contain credentials. With the three digest references exported as `LANDATRIP_PHP_IMAGE`, `LANDATRIP_WEB_IMAGE`, and `LANDATRIP_MYSQL_IMAGE`, `python3 scripts/check-apache-overlay.py` validates the Compose render **without** pulling or building. It rejects tags and any non-loopback published port. The actual deployment later uses `compose.staging.yml` plus `compose.apache.yml`, not `scripts/staging-deploy.sh`; that old script builds images and runs migrations on the target host. The exact migration, backup, and startup commands require a separately reviewed release procedure.

## Approval gates and cutover order

1. Approve an ARM64 Azure VM upgrade with measured headroom, maintenance window, price, public IP and rollback plan. The existing 952 MiB VM is blocked. An approved separate staging VM is an alternative for testing, not extra capacity on this host.
2. Approve and verify the protected `.ca` source and Apache backups, a disposable restore, and a working rollback destination for the currently absent port-5001 service.
3. Approve the reviewed `main` commit and off-host GHCR publication. Record and independently verify PHP, Nginx, and MySQL ARM64 digests; check registry access and the loopback-only Compose render.
4. Approve a distinct database and storage backup plan, synthetic-only validation, reviewed migrations, and a forward-repair strategy. Keep commercial checkout blocked at HTTP 409 and synthetic E2E payment routes inaccessible.
5. Only after the upgraded host has adequate RAM, prepare the digest-pinned stack on `127.0.0.1:18080` and verify health, login, API roles, cookies, assets, checkout gating, and backups **without** changing Apache. Do not expose PHP-FPM or MySQL host ports.
6. Explicitly approve the `landatrip.ca` HTTP and HTTPS virtual-host cutover, Basic credential handling, a temporary HTTP-to-HTTPS redirect, test window, monitoring, and rollback. Validate the rendered file with `apache2ctl -t` before an administrator-applied reload. Do not use `landatrip.com` as a fallback or active target.

PR #8 can be reviewed and manually merged as preparation once its isolated Apache and hosted checks pass. Merging it is not approval for any of the six infrastructure or cutover gates above.
