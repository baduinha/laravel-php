# Multi-stage Dockerfile for Laravel production use.
# Stage 1: builder installs PHP + node dependencies and builds assets.
FROM php:8.4-fpm-alpine AS builder

WORKDIR /var/www/html

# Build dependencies for Composer, PHP extensions and npm build.
RUN apk add --no-cache --virtual .build-deps \
        autoconf \
        g++ \
        make \
        libzip-dev \
        sqlite-dev \
        oniguruma-dev \
        bash \
        nodejs \
        npm \
        curl \
    && docker-php-ext-install pdo_sqlite zip \
    && curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

# Copy only dependency manifests first to leverage build cache.
COPY composer.json composer.lock ./
COPY package.json ./

# Install PHP and JavaScript dependencies. No app source yet required.
RUN composer install --prefer-dist --no-dev --no-scripts --no-progress --no-interaction --optimize-autoloader \
    && npm install

# Copy application source now that dependencies are ready.
COPY . .
RUN rm -f bootstrap/cache/*.php || true

# Build Vite assets for production.
RUN npm run build \
    && composer dump-autoload --optimize

# Stage 2: runtime image
FROM php:8.4-fpm-alpine AS production
WORKDIR /var/www/html

# Runtime dependencies only; compile SQLite and then remove build tools for a smaller final image.
RUN apk add --no-cache --virtual .build-deps \
        sqlite-dev \
        autoconf \
        g++ \
        make \
    && docker-php-ext-install pdo_sqlite \
    && apk del .build-deps \
    && apk add --no-cache sqlite

# Copy built application files from the builder stage.
COPY --from=builder /var/www/html /var/www/html
RUN rm -rf /var/www/html/node_modules
COPY docker/app-healthcheck.sh /usr/local/bin/healthcheck.sh
RUN chmod +x /usr/local/bin/healthcheck.sh \
    && chown -R www-data:www-data /var/www/html

# Do not run as root; use the standard www-data user.
USER www-data

EXPOSE 8000

# Entrypoint for a containerized Laravel app serving on port 8000.
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
