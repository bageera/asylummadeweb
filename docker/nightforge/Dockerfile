# ==================================================
# Nightforge Build-Only Image — Laravel (Blade-only)
# Project: asylummade
# ==================================================

############################
# Stage 1 — Composer Dependencies
############################
FROM composer:2 AS vendor

WORKDIR /app

# Copy only dependency manifests for cache efficiency
COPY composer.json composer.lock ./

RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --optimize-autoloader

############################
# Stage 2 — Runtime (php-fpm)
############################
FROM php:8.2-fpm-alpine

# --------------------------------------------------
# System packages + PHP extensions
# --------------------------------------------------
RUN apk add --no-cache \
        bash \
        icu-dev \
        libzip-dev \
        oniguruma-dev \
    && docker-php-ext-install \
        intl \
        zip \
        opcache \
    && rm -rf /var/cache/apk/*

# --------------------------------------------------
# PHP configuration
# --------------------------------------------------
COPY docker/nightforge/php.ini /usr/local/etc/php/conf.d/app.ini

# --------------------------------------------------
# Application directory
# --------------------------------------------------
WORKDIR /var/www/html

# --------------------------------------------------
# Copy application source
# --------------------------------------------------
COPY . .

# --------------------------------------------------
# Copy vendor dependencies from build stage
# --------------------------------------------------
COPY --from=vendor /app/vendor ./vendor

# --------------------------------------------------
# Laravel build-time optimizations
# (safe without .env)
# --------------------------------------------------
RUN php artisan config:clear \
 && php artisan route:clear \
 && php artisan view:clear \
 && php artisan optimize

# --------------------------------------------------
# Permissions (Nightforge-friendly)
# --------------------------------------------------
RUN chown -R www-data:www-data \
        storage \
        bootstrap/cache

# --------------------------------------------------
# Runtime contract
# - HTTP handled by Nightforge ingress
# - TLS handled upstream
# - Env injected at runtime
# --------------------------------------------------
EXPOSE 9000
CMD ["php-fpm"]
