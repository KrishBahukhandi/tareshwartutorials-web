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

# Render's free tier spins the service down after ~15 min without inbound
# traffic, giving the next visitor a 20s+ cold start. Requesting our own
# public URL every 5 minutes keeps the idle timer from ever firing. The
# request must go through the public URL (not localhost) so it registers
# as traffic at Render's edge. Set SELF_PING_URL to override which URL is
# pinged; the loop is skipped entirely when both it and APP_URL are unset.
PING_URL="${SELF_PING_URL:-${APP_URL:+${APP_URL}/up}}"
if [ -n "${PING_URL}" ]; then
    (
        while true; do
            sleep 300
            curl -fsS --max-time 30 --retry 2 --retry-delay 5 "${PING_URL}" > /dev/null 2>&1 || true
        done
    ) &
fi

exec apache2-foreground
