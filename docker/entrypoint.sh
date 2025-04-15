#!/bin/bash

if [ ! -f "vendor/autoload.php" ]; then
    composer install --no-progress --no-interaction
fi

if [ ! -f ".env" ]; then
    echo "Creating env file for env $APP_ENV"
    cp .env.example .env
fi

# Выполняем миграции и сидеры, но только если таблица не существует
if [ ! -f /var/www/storage/installed ]; then
  echo "Выполняем миграции и сиды..."
  php artisan migrate:fresh --seed --force
  touch /var/www/storage/installed
else
  echo "Приложение уже установлено, миграции пропускаем."
fi

php-fpm -D

tail -f /dev/null