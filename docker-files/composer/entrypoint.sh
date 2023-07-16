#! /bin/bash

# install composer dependencies
if [ ! -f "vendor/autoload.php" ]; then
    #if depencies has already been installed don't rerun
    composer install
fi #end if

# copy .env.example file if .env file does not exist
if [ ! -f ".env"]; then
    echo "Creating .env file for env $APP_ENV"
    cp .env.example .env
else
    echo "env file exists"
fi

role=${CONTAINER_ROLE:-composer}

# for only the composer
if [ "$role" = "composer" ]; then
    php artisan migrate
    php artisan key:generate
    php artisan optimize:clear
    php artisan db:seed
fi

echo "Done"