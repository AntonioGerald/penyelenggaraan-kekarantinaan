FROM php:8.2-cli

# Install system dependencies for GD
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql

# Set working directory
WORKDIR /app

# Copy all project files
COPY . .

# Copy composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Install PHP dependencies
RUN composer install --optimize-autoloader --no-interaction

# Expose port
EXPOSE 8000

# Run Laravel
CMD php artisan migrate --force && php -S 0.0.0.0:$PORT -t public
