## Запуск

docker-compose up nginx -d

docker-compose run composer install

docker exec php-spares cp .env.example .env

docker-compose run artisan key:generate

docker-compose run artisan migrate

docker-compose run artisan db:seed

docker-compose run artisan test

