#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
if [[ ! -f .env.staging ]]; then echo 'Create .env.staging first.' >&2; exit 1; fi
if [[ -e .staging-credentials ]]; then echo 'Credentials file already exists; refusing to rotate silently.' >&2; exit 1; fi
umask 077
{
  for role in ADMIN MANAGER TEACHER AGENT USER; do
    printf 'STAGING_DEMO_PASSWORD_%s=%s\n' "$role" "$(openssl rand -hex 24)"
  done
} > .staging-credentials
set -a
source .staging-credentials
set +a
compose=(docker compose --env-file .env.staging -f compose.staging.yml)
"${compose[@]}" exec -T -u www-data -e STAGING_DEMO_SEED=yes \
  -e STAGING_DEMO_PASSWORD_ADMIN -e STAGING_DEMO_PASSWORD_MANAGER \
  -e STAGING_DEMO_PASSWORD_TEACHER -e STAGING_DEMO_PASSWORD_AGENT \
  -e STAGING_DEMO_PASSWORD_USER app php artisan db:seed --class=StagingDemoSeeder --force
printf 'Synthetic accounts: staging-{admin,manager,teacher,agent,user}@example.invalid\nPasswords saved in .staging-credentials (mode 600).\n'
