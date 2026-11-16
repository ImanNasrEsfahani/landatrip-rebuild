# Staging deployment

## Local validation

Prerequisites: Docker Engine, Compose v2, OpenSSL, Python 3, Node 22 and Chromium for Playwright. In a clean checkout:

```bash
bash scripts/staging-local-init.sh
STAGING_EDGE=local bash scripts/staging-deploy.sh
bash scripts/staging-seed.sh
set -a; source .staging-access; source .staging-credentials; set +a
npm ci
npx playwright install chromium
npm run test:staging
```

Visit `https://localhost:8443` with the credentials in `.staging-access`. Caddy uses a local CA for this URL, so trust the certificate from the Caddy volume in your browser or use an isolated browser profile that accepts the local certificate. This loopback URL is accessible only on this computer. The seed script stores separate random 48-character passwords for the five users in `.staging-credentials`; the files are ignored by Git and mode 600. Do not share them in screenshots or CI logs.

The deploy script requires a clean checkout and tags images with the exact commit SHA. To rebuild after a change, commit it first. For a smoke test without seeding, the health endpoint is `https://localhost:8443/healthz`. `docker compose --env-file .env.staging -f compose.staging.yml -f compose.staging.local.yml logs -f app web scheduler` inspects logs. Stop the local stack with the same Compose file pair and `down` (no `-v`).

## Server deployment

1. Allocate a nonproduction Linux host or an isolated Docker installation. Point a new staging DNS A/AAAA record to it. Open 80/443 for Caddy's ACME HTTP challenge and HTTPS. Ensure those host ports are free; if a live proxy already owns them, use the loopback port approach in the architecture document and arrange access protection and certificates there.
2. Fetch the reviewed commit into a clean checkout and detach it: `git checkout --detach <full-reviewed-sha>`.
3. Copy `.env.staging.example` to `.env.staging`; set `APP_URL=https://<host>`, `STAGING_DOMAIN=<host>`, separate random app and root DB passwords, a random `APP_KEY` (`base64:` plus 32 random bytes), and a Caddy password hash (`docker run --rm caddy:2.10-alpine caddy hash-password`). Single-quote the hash in `.env.staging` so Compose does not interpolate its `$` characters. Set `CORS_ALLOWED_ORIGINS` to the same HTTPS origin and `SANCTUM_STATEFUL_DOMAINS` to the hostname. Keep `TRUSTED_PROXIES=*` only while the app and Nginx are private Compose services. Set `SESSION_SECURE_COOKIE=true`, `APP_ENV=staging`, and `APP_DEBUG=false`. The example lists every staging variable. Run `chmod 600 .env.staging`.
4. If using an intercepting corporate CA, set `STAGING_CA_BUNDLE=/absolute/path/to/ca-bundle.pem` for the build. This enables the optional `compose.staging.ca.yml` override; leave it unset on normal servers and CI. The deploy script stages it as a temporary ignored file inside the checkout for Buildx, mounts it as a build secret, and removes the temporary file when done. It is not copied into the image.
5. Run `bash scripts/staging-deploy.sh`. It builds images, starts private services, applies forward-only `php artisan migrate --force`, caches configuration and views, then starts Caddy and the scheduler. For updates, take a backup before running the script. Never run `migrate:fresh`, `db:wipe`, or `down -v` on persistent staging.
6. On a fresh empty database only, run `bash scripts/staging-seed.sh` if synthetic demo content is desired. Keep `.staging-credentials` on the host and rotate or delete them after use.
7. Check `docker compose --env-file .env.staging -f compose.staging.yml ps`, authenticated `https://<host>/healthz`, all five logins, assets, and the tests below. Caddy obtains and renews the certificate automatically after DNS resolves.

For a backup, run `docker compose --env-file .env.staging -f compose.staging.yml exec -T mysql sh -c 'exec mysqldump -u root -p"$MYSQL_ROOT_PASSWORD" --single-transaction --routines landatrip_staging' > staging-$(date +%Y%m%d).sql` and protect the file with mode 600. Snapshot the `staging_storage` named volume separately. Test restoration on a disposable database, not the live staging database.

Run `npm ci && npm run test:staging` with `STAGING_BASE_URL`, HTTP Basic credentials, and the synthetic passwords exported from protected files. The existing `bash scripts/e2e-run.sh` remains a separate disposable checkout suite. `docker compose --env-file .env.staging -f compose.staging.yml logs -f` and `exec app php artisan migrate:status` aid troubleshooting. Stop with `docker compose --env-file .env.staging -f compose.staging.yml --profile public down` without `-v`.
