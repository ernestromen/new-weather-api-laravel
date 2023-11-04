# Use the official PHP image with Apache
FROM php:8.1-apache

# Enable necessary Apache modules
RUN a2enmod rewrite

# Install system dependencies
RUN apt-get update && \
    apt-get install -y \
        git \
        unzip \
        libpq-dev && \
    docker-php-ext-install pdo pdo_mysql

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set the working directory
WORKDIR /var/www/backend

# Copy the composer files first to take advantage of Docker's caching
COPY composer.json composer.lock ./
RUN composer update --no-scripts --no-autoloader
# Install Composer dependencies
RUN composer install --no-scripts --no-autoloader

# Copy the rest of the application
COPY . .

# Dump the autoloader and optimize
RUN composer dump-autoload --optimize

# Install Xdebug
RUN pecl install xdebug

# Copy the Apache configuration
# COPY apacheconf.conf /etc/apache2/sites-available/
# RUN a2ensite apacheconf.conf

# Expose the container's Apache port
EXPOSE 80
# RUN chown -R www-data:www-data var/cache var/log
# Start Apache with PHP
CMD ["apache2-foreground"]