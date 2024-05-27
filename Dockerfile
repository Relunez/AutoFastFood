FROM php:8.2
LABEL authors="Relunez"

ARG USER=1000
ARG GROUP=1000

RUN apt-get update && apt-get install -y zip unzip git libcurl4-openssl-dev curl libzip-dev \
    && docker-php-ext-install pdo pdo_mysql zip \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && rm -rf /var/cache/apt/archives /var/lib/apt/lists

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN groupadd -g $GROUP docker && useradd -u $USER -g $GROUP -m -s /bin/bash docker

WORKDIR /var/www

USER docker

EXPOSE 8000
