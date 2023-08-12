#!/bin/bash

main() {
    docker compose exec php php artisan migrate:fresh
    docker compose exec php php artisan test
}

main