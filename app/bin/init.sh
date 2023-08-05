#!/bin/bash

main() {
    composer install

    if [ ! -e ./.env ]; then
        cp .env.example .env
        php artisan key:generate
    fi

    php artisan storage:link
    chmod 777 -R ./*
}

main
