#!/usr/bin/env bash
set -euo pipefail

PORT="${PORT:-10000}"

# Render assigns the port at runtime, so Apache's listen port and the vhost
# both get patched at container start rather than baked in at build time.
sed -i "s/Listen 80/Listen ${PORT}/" /etc/apache2/ports.conf
sed -i "s/__PORT__/${PORT}/" /etc/apache2/sites-available/000-default.conf

# Config/route/view caches depend on real env vars, which only exist at
# runtime on Render (not during `docker build`), so caching happens here.
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Safe to run on every boot: Laravel's migrator only applies pending
# migrations, so this is a no-op once the schema is already current.
php artisan migrate --force

# Only meaningful when PUBLIC_FILES_DISK=public; harmless otherwise.
php artisan storage:link || true

exec apache2-foreground
