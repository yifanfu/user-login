FROM php:fpm
RUN apt-get update && apt-get install -y \
    git \
    zip \
    unzip
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN pecl install redis && docker-php-ext-enable redis

RUN curl -sL https://getcomposer.org/installer | php -- --install-dir /usr/bin --filename composer

WORKDIR /var/www/html
COPY ./ ./
RUN composer install