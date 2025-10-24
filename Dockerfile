# Use PHP 8.2 with Apache
FROM php:8.2-apache

# Install required system packages
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libzip-dev libonig-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_pgsql bcmath mbstring zip exif pcntl tokenizer xml

# Enable Apache rewrite module (needed for Laravel routes)
RUN a2enmod rewrite

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy app files
COPY . .

# Ensure storage & bootstrap/cache are writable
RUN chmod -R 775 storage bootstrap/cache

# Install PHP dependencies (ignore platform reqs to fix extension mismatch)
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Generate Laravel app key (ignore if exists)
RUN php artisan key:generate || true

# Run migrations (ignore if fails on build)
RUN php artisan migrate --force || true

# Cache configs and routes
RUN php artisan config:cache || true
RUN php artisan route:cache || true

# Expose port
EXPOSE 10000

# Start Laravel server
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
