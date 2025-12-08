FROM php:8.3-cli

# Install system dependencies
# Added libzip-dev which is required for the php zip extension
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions required by Laravel
# Added 'zip' to the list
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www/html

# Copy existing application directory contents
COPY . /var/www/html

# Install dependencies
RUN composer install --optimize-autoloader --no-dev

# Expose port 8000 (The default Laravel "serve" port)
EXPOSE 8000

# Start Laravel using the built-in server
CMD php artisan serve --host=0.0.0.0 --port=8000