#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
if [[ -e .env.staging || -e .staging-access ]]; then echo 'Staging configuration already exists.' >&2; exit 1; fi
umask 077
app_key="base64:$(openssl rand -base64 32)"
db_password="$(openssl rand -hex 24)"
root_password="$(openssl rand -hex 24)"
access_password="$(openssl rand -hex 24)"
access_hash="$(docker run --rm caddy:2.10-alpine caddy hash-password --plaintext "$access_password")"
python3 - "$app_key" "$db_password" "$root_password" "$access_hash" <<'PY'
from pathlib import Path
import sys
key, db, root, access = sys.argv[1:]
s = Path('.env.staging.example').read_text()
for old, new in {
    'https://staging.example.invalid': 'https://localhost:8443',
    'staging.example.invalid': 'localhost:8443',
    'REPLACE_WITH_php_artisan_key_generate_show': key,
    'REPLACE_WITH_RANDOM_ROOT_PASSWORD': root,
    'REPLACE_WITH_RANDOM_APP_PASSWORD': db,
    'REPLACE_WITH_caddy_hash_password': "'" + access + "'",
}.items(): s = s.replace(old, new)
s = s.replace('STAGING_DOMAIN=localhost:8443', 'STAGING_DOMAIN=localhost')
Path('.env.staging').write_text(s)
PY
printf 'STAGING_ACCESS_USER=staging\nSTAGING_ACCESS_PASSWORD=%s\n' "$access_password" > .staging-access
printf 'Created .env.staging and .staging-access with mode 600.\n'
