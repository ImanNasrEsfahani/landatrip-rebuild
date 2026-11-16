FROM debian:trixie-slim

RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates curl git unzip composer \
    php8.4-cli php8.4-curl php8.4-gd php8.4-http php8.4-intl \
    php8.4-mbstring php8.4-mysql php8.4-raphf php8.4-xml php8.4-zip \
    && rm -rf /var/lib/apt/lists/*

WORKDIR /app
EXPOSE 8000
