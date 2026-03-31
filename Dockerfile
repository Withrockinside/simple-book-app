FROM php:8.5-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git curl libpng-dev libonig-dev libxml2-dev zip unzip

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy only composer files first to leverage Docker cache
COPY composer.json composer.lock ./

# Install dependencies (ignoring scripts for now because the full code isn't there yet)
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application code
COPY . .

# Finish composer (generate autoloader and run scripts)
RUN composer dump-autoload --optimize

# Set permissions (important for Laravel)
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

USER www-data