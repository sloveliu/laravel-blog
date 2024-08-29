#!/bin/bash
printf "\n\nStarting PHP 7.4 daemon...\n\n"
php-fpm7 --daemonize
printf "Starting Nginx...\n\n"
set -e
npm run watch-poll &
if [[ "$1" == -* ]]; then
    set -- nginx -g daemon off; "$@"
fi
exec "$@"
