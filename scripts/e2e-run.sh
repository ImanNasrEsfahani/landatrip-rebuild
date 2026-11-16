#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."
export E2E_APP_KEY="${E2E_APP_KEY:-base64:$(node -e 'process.stdout.write(require("crypto").randomBytes(32).toString("base64"))')}"
export E2E_TEST_PASSWORD="${E2E_TEST_PASSWORD:-$(node -e 'process.stdout.write(require("crypto").randomBytes(24).toString("hex"))')}"
export VITE_APP_URL=http://127.0.0.1:8000
cat > .env.e2e <<EOF
APP_NAME=LandaTrip
APP_ENV=local
APP_DEBUG=false
APP_URL=http://127.0.0.1:8000
APP_KEY=$E2E_APP_KEY
DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=landatrip_e2e
DB_USERNAME=landatrip_e2e
DB_PASSWORD=e2e-only
CACHE_STORE=array
SESSION_DRIVER=file
QUEUE_CONNECTION=sync
MAIL_MAILER=array
SCOUT_DRIVER=null
FILESYSTEM_DISK=local
TEST_ENABLED=false
EOF
chmod 600 .env.e2e

compose=(docker compose -f docker-compose.e2e.yml)
if [[ "${E2E_REUSE_DEPS:-0}" == 1 ]]; then
  test -f vendor/autoload.php && test -d node_modules/@playwright/test && test -f public/build/manifest.json
else
  "${compose[@]}" build app
  composer_args=()
  local_ca="${E2E_CA_BUNDLE:-/workspace/.cloud-setup/ca-bundle.pem}"
  if [[ -f "$local_ca" ]]; then
    composer_args+=(-v "$local_ca:/tmp/e2e-ca.pem:ro" -e COMPOSER_CAFILE=/tmp/e2e-ca.pem -e SSL_CERT_FILE=/tmp/e2e-ca.pem)
  fi
  if [[ -d /workspace/.cloud-setup/composer-cache ]]; then
    composer_args+=(-v /workspace/.cloud-setup/composer-cache:/tmp/composer-cache -e COMPOSER_CACHE_DIR=/tmp/composer-cache)
  fi
  "${compose[@]}" run --rm --no-deps "${composer_args[@]}" app composer install --no-interaction --prefer-dist --optimize-autoloader
  npm ci
  npm run build
fi
"${compose[@]}" up -d mysql
"${compose[@]}" run --rm app php artisan migrate:fresh --force
"${compose[@]}" run --rm app php artisan db:seed --class=E2eSeeder --force
"${compose[@]}" run --rm app php artisan storage:link
"${compose[@]}" up -d app

if [[ -z "${E2E_CHROMIUM_PATH:-}" ]] && command -v chromium >/dev/null 2>&1; then
  export E2E_CHROMIUM_PATH="$(command -v chromium)"
fi
if [[ -z "${E2E_CHROMIUM_PATH:-}" ]]; then
  if [[ -n "${CI:-}" ]]; then
    npx playwright install --with-deps chromium
  else
    npx playwright install chromium
  fi
fi
npm run test:e2e -- "$@"
