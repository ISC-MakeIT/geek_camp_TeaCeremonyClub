#!/bin/bash

main() {
    apache2-foreground &
    npm run dev &

    wait
}

main
