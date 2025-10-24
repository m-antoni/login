# 1️⃣ Start from a base image
FROM php:8.2-fpm

# 2️⃣ Install required system packages or extensions
RUN apt-get update && apt-get install -y \
    git curl zip unzip libpq-dev libonig-dev libzip-dev libxml2-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring zip exif pcntl bcmath

# 3️⃣ Copy your application code into the container
WORKDIR /var/www/html
COPY . .

# 4️⃣ Install PHP dependencies (using Composer)
COPY --from=composer:2.8 /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# 5️⃣ Optional: generate key or do other Laravel setup
RUN php artisan key:generate

# 6️⃣ Expose the port Laravel runs on
EXPOSE 8000

# 7️⃣ Start the Laravel app
CMD php artisan serve --host=0.0.0.0 --port=$PORT
