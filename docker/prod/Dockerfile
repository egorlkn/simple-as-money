FROM composer:2.0.13 AS composer
FROM jelastic/nginxphp:1.18.0-php-8.0.3

COPY --from=composer /usr/bin/composer /usr/bin/composer

COPY ./ ./docker/prod/.env.local /var/www/webroot/

COPY ./docker/prod/nginx.conf /etc/nginx/nginx.conf

EXPOSE 80

WORKDIR /var/www/webroot

CMD ["bash", "bin/cmd.sh"]
