FROM php:8.2-apache
RUN apt-get update && apt-get install -y \
    unzip git zip libzip-dev libssl-dev \
    && docker-php-ext-install zip pdo pdo_mysql
RUN pecl install mongodb && docker-php-ext-enable mongodb
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer
WORKDIR /var/www/html
COPY composer.json ./
RUN composer install --no-interaction --prefer-dist
COPY . .
EXPOSE 80