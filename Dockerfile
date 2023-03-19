FROM composer:2.5 as build

WORKDIR /app

COPY site/composer.* .
RUN composer install --no-dev --no-scripts --ignore-platform-reqs

COPY site .
RUN mv env .env && composer dumpautoload --optimize

FROM bitnami/php-fpm:7.4

WORKDIR /app
COPY --from=build /app /app