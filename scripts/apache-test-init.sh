#!/usr/bin/env bash
set -euo pipefail
cd "$(dirname "$0")/.."
if [[ ! -f .staging-access || ! -f .env.staging ]]; then
  echo 'Initialize disposable staging first.' >&2
  exit 1
fi
umask 077
mkdir -p .apache-test
chmod 755 .apache-test
openssl req -x509 -newkey rsa:2048 -nodes -days 1 \
  -keyout .apache-test/key.pem -out .apache-test/cert.pem \
  -subj '/CN=localhost' -addext 'subjectAltName=DNS:localhost' >/dev/null 2>&1
set -a
source .staging-access
set +a
access_hash="$(printf '%s' "$STAGING_ACCESS_PASSWORD" | openssl passwd -apr1 -stdin)"
printf '%s:%s\n' "$STAGING_ACCESS_USER" "$access_hash" > .apache-test/users
chmod 644 .apache-test/users
python3 - <<'PY'
from pathlib import Path

config = Path('deploy/apache/landatrip.ca.conf.template').read_text()
values = {
    '@HTTP_LISTEN@': '8081',
    '@HTTPS_LISTEN@': '8444',
    '# TEST_LISTEN_MARKER (production Apache already listens on 80 and 443)': 'Listen 8081\nListen 8444',
    '@SERVER_NAME@': 'localhost',
    '@HTTPS_ORIGIN@': 'https://localhost:18443',
    '@CERT_FILE@': '/run/landatrip-test/cert.pem',
    '@KEY_FILE@': '/run/landatrip-test/key.pem',
    '@AUTH_FILE@': '/run/landatrip-test/users',
    '@HTTPS_PORT@': '18443',
    '@UPSTREAM@': 'http://web:8080',
    '# TEST_PROBE_PROXY': 'ProxyPass /__proxy_probe http://header-probe:8082/__proxy_probe',
}
for old, new in values.items():
    if old not in config:
        raise SystemExit(f'Missing Apache template marker: {old}')
    config = config.replace(old, new)
if '@' in config:
    raise SystemExit('Unrendered Apache template marker')
Path('.apache-test/landatrip.conf').write_text(config)
PY
