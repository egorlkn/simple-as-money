FROM jelastic/nginxphp:1.18.0-php-8.0.3
FROM composer:2.0.13 AS composer

COPY ./ ./docker/prod/.env.local /var/www/webroot/ROOT/

COPY --from=composer /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/webroot/ROOT

RUN composer install --no-dev --optimize-autoloader --no-interaction && composer dump-env prod

EXPOSE 80

CMD service php-fpm start && nginx -g "daemon off;"
