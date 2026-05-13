#!/bin/sh
# Healthcheck script for the Laravel application container.
# It validates that the Laravel bootstrap works and the app can respond.
set -e

if [ ! -f ./artisan ] || [ ! -f ./bootstrap/app.php ]; then
  echo "Laravel bootstrap files missing"
  exit 1
fi

php artisan route:list > /dev/null 2>&1
