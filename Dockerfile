FROM php:7.3.29-fpm-alpine3.14
RUN apk add --no-cache --virtual .build-deps $PHPIZE_DEPS
RUN pecl install xdebug
RUN docker-php-ext-enable xdebug
RUN apk del -f .build-deps
ENV XDEBUG_MODE=coverage
