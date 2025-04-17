# Use the official PHP 8.2 Apache image
FROM php:8.2-apache

# Install system packages needed for MongoDB extension
RUN apt-get update && apt-get install -y \
    libssl-dev \
    pkg-config \
    git \
    unzip \
    && docker-php-source extract \
    && pecl install mongodb \
    && docker-php-ext-enable mongodb \
    && docker-php-source delete

# Enable Apache rewrite module (for pretty URLs if you need)
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy all files into container
COPY . /var/www/html

# Set permissions (optional but helpful)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache server (automatic)
CMD ["apache2-foreground"]
