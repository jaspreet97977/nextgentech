# Use the official PHP 8.2 Apache image
FROM php:8.2-apache

# Install system packages needed for MongoDB extension and Composer
RUN apt-get update && apt-get install -y \
    libssl-dev \
    pkg-config \
    git \
    unzip \
    curl \
    && docker-php-source extract \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && docker-php-source delete \
    && a2enmod rewrite

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Set working directory
WORKDIR /var/www/html

# Copy project files (except vendor)
COPY . /var/www/html

# Install PHP dependencies inside Docker
RUN composer install --no-dev --optimize-autoloader

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
