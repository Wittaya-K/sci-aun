FROM php:8.3-fpm-alpine

# ── System dependencies ──────────────────────────────────────
RUN apk add --no-cache \
    bash \
    curl \
    git \
    unzip \
    nodejs \
    npm \
    libpng-dev \
    libjpeg-turbo-dev \
    freetype-dev \
    libzip-dev \
    oniguruma-dev \
    icu-dev

# ── PHP extensions ───────────────────────────────────────────
RUN docker-php-ext-configure gd \
        --with-freetype \
        --with-jpeg \
    && docker-php-ext-install \
        pdo_mysql \
        mbstring \
        zip \
        gd \
        bcmath \
        intl \
        opcache

# ── Composer ─────────────────────────────────────────────────
COPY --from=composer:2.7 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# ── Install PHP dependencies ─────────────────────────────────
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-scripts --no-autoloader --prefer-dist

# ── Copy source ──────────────────────────────────────────────
COPY . .

# ── สร้าง .env ชั่วคราวสำหรับ build ─────────────────────────
RUN printf 'APP_NAME="AUN"\nAPP_ENV=production\nAPP_KEY=base64:placeholder\n' > .env

# ── Finalize composer ────────────────────────────────────────
RUN composer dump-autoload --optimize

# ── Install & build frontend ─────────────────────────────────
RUN npm ci && npm run build && rm -rf node_modules

# ── ลบ .env ออก (จะ mount จาก host ตอน runtime) ─────────────
RUN rm .env

# ── Permissions ──────────────────────────────────────────────
RUN chown -R www-data:www-data /var/www/html/storage \
    && chown -R www-data:www-data /var/www/html/bootstrap/cache \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
