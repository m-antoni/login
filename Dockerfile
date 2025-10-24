# Use PHP 8.2 with preinstalled Composer and common PHP extensions
FROM webdevops/php-apache:8.2

# Set working directory inside the container
WORKDIR /app

# Copy all Laravel project files into the container
COPY . .

# Install PHP dependencies via Composer
RUN composer install --no-dev --optimize-autoloader --ignore-platform-reqs

# Generate app key (skip if already set)
RUN php artisan key:generate || true

# Cache config and routes
RUN php artisan config:cache || true
RUN php artisan route:cache || true

# Expose the port that Render expects
EXPOSE 10000

# Run migrations, seed the database, then start Laravel
CMD php artisan migrate --force && php artisan db:seed --force && php artisan serve --host=0.0.0.0 --port=10000
