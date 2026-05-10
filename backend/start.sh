#!/bin/sh
echo "=== Tensai starting ==="
php artisan package:discover --ansi || true
php artisan migrate --force
php artisan db:seed --force || true
echo "=== Starting Apache on port 8080 ==="
exec apache2-foreground
