FROM node:22-bookworm-slim AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN --mount=type=secret,id=build_ca,required=false \
    if [ -s /run/secrets/build_ca ]; then \
      export NODE_EXTRA_CA_CERTS=/run/secrets/build_ca; \
      export npm_config_cafile=/run/secrets/build_ca; \
    fi; \
    npm ci --no-audit --no-fund
COPY . .
ARG VITE_APP_URL
ARG VITE_ASSET_URL
ENV VITE_APP_URL=${VITE_APP_URL} VITE_ASSET_URL=${VITE_ASSET_URL}
RUN npm run build && npm run verify:manifest && npm run build:ssr

FROM debian:trixie-slim AS php
ENV DEBIAN_FRONTEND=noninteractive
RUN apt-get update && apt-get install -y --no-install-recommends \
    ca-certificates curl unzip git composer \
    php8.4-fpm php8.4-cli php8.4-bcmath php8.4-curl php8.4-gd \
    php8.4-http php8.4-intl php8.4-mbstring php8.4-mysql \
    php8.4-raphf php8.4-xml php8.4-zip \
    && rm -rf /var/lib/apt/lists/*
RUN sed -i 's|listen = /run/php/php8.4-fpm.sock|listen = 9000|' /etc/php/8.4/fpm/pool.d/www.conf \
    && sed -i 's|^;clear_env = no|clear_env = no|' /etc/php/8.4/fpm/pool.d/www.conf \
    && sed -i 's|^;catch_workers_output = yes|catch_workers_output = yes|' /etc/php/8.4/fpm/pool.d/www.conf
WORKDIR /app
COPY composer.json composer.lock ./
RUN --mount=type=secret,id=build_ca,required=false \
    if [ -s /run/secrets/build_ca ]; then \
      export COMPOSER_CAFILE=/run/secrets/build_ca SSL_CERT_FILE=/run/secrets/build_ca; \
    fi; \
    composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --no-scripts
COPY --chown=www-data:www-data . .
RUN test ! -e public/adminer.php && test ! -e storage/app/public/credentials.json && test ! -e old_app
COPY --from=assets --chown=www-data:www-data /app/public/build /app/public/build
COPY --from=assets --chown=www-data:www-data /app/bootstrap/ssr /app/bootstrap/ssr
RUN rm -f public/hot && ln -s /app/storage/app/public public/storage \
    && mkdir -p storage/app/public storage/framework/cache storage/framework/sessions storage/framework/views storage/logs bootstrap/cache \
    && chown -R www-data:www-data storage bootstrap/cache \
    && composer dump-autoload --no-dev --optimize --no-scripts \
    && php artisan package:discover --ansi
EXPOSE 9000
CMD ["php-fpm8.4", "-F"]

FROM nginx:1.27-alpine AS web
COPY docker/staging/nginx.conf /etc/nginx/conf.d/default.conf
COPY --from=php /app/public /app/public
EXPOSE 8080
