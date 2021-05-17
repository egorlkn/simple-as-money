#!/bin/bash

composer install --no-dev --optimize-autoloader --no-interaction

composer dump-env prod

service php-fpm start

nginx -g "daemon off;"