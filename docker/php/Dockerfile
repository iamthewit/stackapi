FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
   wget \
   git \
   libzip-dev \
   zip \
   unzip \
   default-mysql-client \
   && docker-php-ext-install -j$(nproc) zip

RUN docker-php-ext-install pdo_mysql

#TODO: this:
#COPY php.ini /usr/local/etc/php

#TODO: getthis to work...
#RUN /srv/www/api/docker/php/helper-scripts/install-composer.sh