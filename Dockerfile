# Use PHP with Composer and extensions
FROM php:8.2-apache

# Install dependencies and extensions
RUN apt-get update && apt-get install -y \
    libpq-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_pgsql

# Install Composer globally
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy all Laravel files
COPY . .

# Install dependencies
RUN composer install --no-dev --optimize-autoloader

# Generate app key and cache config
# (Will fail gracefully if APP_KEY already exists)
RUN php artisan key:generate || true
RUN php artisan config:cache || true
RUN php artisan route:cache || true

# Run migrations automatically (safe with --force)
RUN php artisan migrate --force || true

# Expose port Render expects
EXPOSE 10000

# Start Laravel app
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=10000"]
