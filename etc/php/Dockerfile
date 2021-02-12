FROM php:8-fpm-alpine

WORKDIR /var/www/html/

COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer
