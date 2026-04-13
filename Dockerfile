FROM php:8.4-zts-alpine
COPY . /src
COPY composer.json composer.json
WORKDIR /src
RUN apk add --no-cache \
        postgresql-dev \
    && docker-php-ext-install \
        pgsql \
        pdo_pgsql
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install
CMD [ "php", "-S", "0.0.0.0:8080", "-t", "./src" ]
