#!/usr/bin/env python3
"""Read-only validation of a future digest-pinned Apache Compose render."""

import json
import os
import re
import subprocess
import sys


def fail(message):
    raise SystemExit(message)


for variable in ("LANDATRIP_PHP_IMAGE", "LANDATRIP_WEB_IMAGE", "LANDATRIP_MYSQL_IMAGE"):
    value = os.environ.get(variable, "")
    if not re.fullmatch(r"[^\s@]+@sha256:[0-9a-f]{64}", value):
        fail(f"{variable} must be an immutable sha256 image reference")

result = subprocess.run(
    ["docker", "compose", "--env-file", ".env.staging", "-f", "compose.staging.yml", "-f", "compose.apache.yml", "config", "--format", "json"],
    capture_output=True,
    text=True,
)
if result.returncode:
    fail("Apache Compose configuration is invalid; inspect it locally without printing secrets")

services = json.loads(result.stdout)["services"]
if set(services) != {"mysql", "app", "scheduler", "web"}:
    fail("Unexpected active Apache Compose services")
for name, service in services.items():
    if service.get("build"):
        fail(f"{name} would build on the server")
    if service.get("platform") != "linux/arm64":
        fail(f"{name} must be pinned to linux/arm64")
    expected = {
        "mysql": os.environ["LANDATRIP_MYSQL_IMAGE"],
        "app": os.environ["LANDATRIP_PHP_IMAGE"],
        "scheduler": os.environ["LANDATRIP_PHP_IMAGE"],
        "web": os.environ["LANDATRIP_WEB_IMAGE"],
    }[name]
    if service.get("image") != expected:
        fail(f"Unexpected {name} image")
    ports = service.get("ports", [])
    if name != "web" and ports:
        fail(f"{name} publishes a port")
    if name == "web" and ports != [{
        "mode": "ingress", "host_ip": "127.0.0.1", "target": 8080,
        "published": "18080", "protocol": "tcp",
    }]:
        fail("Web must publish only 127.0.0.1:18080 -> 8080")

print("Apache Compose: digest references, ARM64, no builds, loopback-only web port verified")
