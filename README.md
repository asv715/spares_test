## Запуск проекта

docker-compose up nginx -d

docker-compose run composer install

docker exec php-spares cp .env.example .env

docker-compose run artisan key:generate

## Миграции и сиды

docker-compose run artisan migrate

docker-compose run artisan db:seed

## Тесты

docker-compose run artisan test

## Запуск очереди

docker-compose run artisan queue:work