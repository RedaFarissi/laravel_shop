FROM php:8.1-fpm

# system deps
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev libzip-dev zip \
 && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# install composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

# copy composer files and the Laravel bootstrap/app files needed for composer scripts
COPY composer.json composer.lock ./
COPY artisan ./
COPY bootstrap ./bootstrap
RUN composer install --no-dev --optimize-autoloader --no-interaction

# copy the remainder of the application
COPY . .

# permissions
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]