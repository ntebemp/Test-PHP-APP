
FROM php:8.2-apache
RUN docker-php-ext-install pdo pdo_mysql
COPY . /var/www/html
RUN chown -R www-data:www-data /var/www/html
EXPOSE 80

# FROM php:8.2-cli

# # Installe les extensions PHP nécessaires
# RUN apt-get update && apt-get install -y \
#     git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev zip \
#     && docker-php-ext-install pdo_mysql mbstring zip

# # Installe Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# WORKDIR /var/www

# COPY . .

# RUN composer install

# CMD php artisan serve --host=0.0.0.0 --port=8000