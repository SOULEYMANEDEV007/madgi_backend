#!/bin/bash
set -e

echo "==> Stopping old containers..."
docker compose down --remove-orphans 2>/dev/null || true

echo "==> Building image..."
docker compose build --no-cache

echo "==> Starting containers..."
docker compose up -d

echo "==> Waiting for DB to be ready..."
sleep 10

echo "==> Running migrations..."
docker compose exec app php artisan migrate --force

echo "==> Caching config..."
docker compose exec app php artisan config:cache
docker compose exec app php artisan route:cache
docker compose exec app php artisan view:cache

echo "==> Fixing storage permissions..."
docker compose exec app php artisan storage:link 2>/dev/null || true

echo ""
echo "✅ Done! App running at http://150.107.201.90:8080"
