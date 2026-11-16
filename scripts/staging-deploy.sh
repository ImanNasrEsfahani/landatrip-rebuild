#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
if [[ ! -f .env.staging ]]; then echo 'Create .env.staging first.' >&2; exit 1; fi
if [[ -n "$(git status --porcelain)" ]]; then echo 'Checkout must be clean.' >&2; exit 1; fi
if [[ "${STAGING_EDGE:-public}" != local && $(git rev-parse --abbrev-ref HEAD) != HEAD ]]; then echo 'Deploy a detached, reviewed commit SHA.' >&2; exit 1; fi
if ! grep -qx 'APP_ENV=staging' .env.staging || ! grep -qx 'APP_DEBUG=false' .env.staging; then
  echo 'Staging safety settings missing.' >&2; exit 1
fi
if grep -Eq '^(BOOKING_TEST_CHECKOUT_ENABLED|TEST_ENABLED)=true' .env.staging; then
  echo 'Test endpoints must be disabled.' >&2; exit 1
fi
export STAGING_IMAGE_TAG="$(git rev-parse --short=12 HEAD)"
compose=(docker compose --env-file .env.staging -f compose.staging.yml)
"${compose[@]}" config --quiet
if [[ "${STAGING_EDGE:-public}" == local ]]; then
  docker compose --env-file .env.staging -f compose.staging.yml -f compose.staging.local.yml stop local-edge web || true
else
  "${compose[@]}" --profile public stop edge web || true
fi
"${compose[@]}" build app web
"${compose[@]}" up -d mysql app
"${compose[@]}" exec -T -u www-data app php artisan migrate --force
"${compose[@]}" exec -T -u www-data app php artisan config:cache
"${compose[@]}" exec -T -u www-data app php artisan view:cache
"${compose[@]}" up -d --force-recreate web
if [[ "${STAGING_EDGE:-public}" == local ]]; then
  docker compose --env-file .env.staging -f compose.staging.yml -f compose.staging.local.yml up -d --force-recreate scheduler local-edge
  url=https://localhost:8443
else
  "${compose[@]}" --profile public up -d --force-recreate scheduler edge
  url="$(sed -n 's/^APP_URL=//p' .env.staging)"
fi
"${compose[@]}" ps
"${compose[@]}" exec -T web wget -Y off -q -O - http://127.0.0.1:8080/healthz
if [[ "${STAGING_EDGE:-public}" == local && -f .staging-access ]]; then
  set -a
  source .staging-access
  set +a
fi
if [[ -n "${STAGING_ACCESS_PASSWORD:-}" ]]; then
  curl_args=(--fail --silent --show-error --retry 10 --retry-delay 2)
  if [[ "${STAGING_EDGE:-public}" == local ]]; then curl_args+=(-k); fi
  curl "${curl_args[@]}" -u "${STAGING_ACCESS_USER:-staging}:$STAGING_ACCESS_PASSWORD" "$url/healthz"
else
  echo "Verify $url/healthz with staging access credentials."
fi
