FROM php:7.3-fpm

RUN apt-get update && apt-get install -y \
   wget \
   git \
   libzip-dev \
   zip \
   unzip \
   default-mysql-client \
   && docker-php-ext-install -j$(nproc) zip

RUN docker-php-ext-install pdo_mysql

COPY helper-scripts/install-composer.sh /install-composer.sh
RUN /install-composer.sh

WORKDIR /srv/www/api