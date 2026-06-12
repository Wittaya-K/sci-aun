#!/bin/bash
set -e

echo "⏳ Waiting for database..."
until php artisan db:show --no-interaction > /dev/null 2>&1; do
  sleep 2
done

echo "🔑 Generating app key if needed..."
php artisan key:generate --no-interaction --force 2>/dev/null || true

echo "🗄️  Running migrations + seeder..."
php artisan migrate --force --no-interaction
php artisan db:seed --force --no-interaction 2>/dev/null || true

echo "🔗 Creating storage link..."
php artisan storage:link --force 2>/dev/null || true

echo "🚀 Optimizing..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

exec "$@"
