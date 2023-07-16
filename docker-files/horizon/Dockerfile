FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/optix

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    libbz2-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libreadline-dev \
    libonig-dev \
    libpq-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pcntl pdo pdo_pgsql

# Install redis extensions
RUN pecl install redis \
    && docker-php-ext-enable redis

ENTRYPOINT [ "docker-files/horizon/entrypoint.sh" ]
