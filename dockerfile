FROM php:8.2-cli

# MySQL sürücülerini ve gerekli kütüphaneleri kur
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libzip-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo pdo_mysql

WORKDIR /var/www