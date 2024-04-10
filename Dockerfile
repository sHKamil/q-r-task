FROM php:8.2-fpm

ARG HOST_USER_ID

RUN usermod -u $HOST_USER_ID www-data

RUN apt-get update && apt-get install -y

RUN apt-get update && apt-get install -y --no-install-recommends \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
    && docker-php-ext-install \
        zip \
        intl 
  

COPY application/ /var/www/html

CMD ["php-fpm"]

WORKDIR /var/www/html/
