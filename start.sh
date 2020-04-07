#!/usr/bin/env bash

docker container create kyleparisi/larasible

set -e

[ -f ".env.prod" ]

export $(cat .env.prod | grep -v ^# | xargs);
echo Starting services
docker-compose up -d
echo Host: 127.0.0.1
until docker-compose exec mysql mysql -h 127.0.0.1 -u $DB_USERNAME -p$DB_PASSWORD -D $DB_DATABASE --silent -e "show databases;"
do
  echo "Waiting for database connection..."
  sleep 5
done
echo Installing dependencies

rm -f bootstrap/cache/*.php

docker run --rm -v $(pwd):/app composer install
echo php artisan migrate && echo Database migrated
echo php artisan db:seed && echo Database seeded
echo php artisan serve --port=8080 && echo Serving on Port 8080