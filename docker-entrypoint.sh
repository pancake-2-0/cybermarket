#!/bin/bash
set -e

if [ -z "${APP_KEY:-}" ]; then
    echo "ERROR: APP_KEY is not configured in the Railway app service."
    exit 1
fi

if [ "${DB_CONNECTION:-}" != "mysql" ]; then
    echo "ERROR: DB_CONNECTION must be set to mysql in the Railway app service."
    exit 1
fi

if [ -z "${DB_URL:-}" ] && [ -z "${DB_HOST:-}" ]; then
    echo "ERROR: Set DB_URL to the Railway MySQL reference variable."
    exit 1
fi

echo "Clearing Laravel configuration cache..."
php artisan config:clear

echo "Running database migrations..."
php artisan migrate --force

echo "Seeding database..."
php artisan db:seed --force

# Disable all conflicting Apache MPM modules
# Railway can sometimes load extra MPMs at startup, so force only prefork.
a2dismod mpm_event 2>/dev/null || true
a2dismod mpm_worker 2>/dev/null || true
a2dismod mpm_prefork 2>/dev/null || true

a2enmod mpm_prefork rewrite

exec apache2-foreground
