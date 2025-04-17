# ✅ Always start with a FROM instruction
FROM php:8.2-apache

# Install system packages needed for MongoDB extension
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

# Set working directory
WORKDIR /var/www/html

# Copy project files including vendor
COPY . /var/www/html

# Set permissions (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
