docker container create kyleparisi/larasible

set -e

[ -f ".env.prod" ]

export $(cat .env.prod | grep -v ^# | xargs);
echo Starting services
docker-compose up -d
echo Host: 127.0.0.1
until docker-compose exec mysql mysql -p$DB_PASSWORD -e  "CREATE DATABASE IF NOT EXISTS apiBoxNew;"
do
  echo "Waiting for database connection..."
  sleep 5
done

echo Installing dependencies

rm -f bootstrap/cache/*.php

docker run --rm -v $(pwd):/app composer install
php artisan migrate 
php artisan db:seed --class=DataSeeder
php artisan serve --port=8080