# Use an official PHP image with extensions for Laravel
FROM php:8.1-fpm

# Install system dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

# Install Composer globally
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install PHP extensions required for Laravel
RUN docker-php-ext-install pdo_mysql mbstring bcmath

# Increase PHP memory limit
RUN echo "memory_limit = 512M" >> /usr/local/etc/php/conf.d/memory-limit.ini

# Set working directory
WORKDIR /app

# Copy composer files
COPY composer.json composer.lock ./

# Install PHP dependencies without executing scripts, adding verbose for more output
RUN composer install --no-scripts --no-dev --prefer-dist --verbose

# Copy the rest of the application code
COPY . .

# Ensure proper permissions for storage and cache directories
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache \
    && chmod -R 775 /app/storage /app/bootstrap/cache

# Expose port 80 for the application
EXPOSE 80

# Start the application using artisan serve
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
