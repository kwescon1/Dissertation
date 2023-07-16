FROM php:8.2-fpm

# Set working directory
WORKDIR /var/www/optix

# Install dependencies
RUN apt-get update && apt-get install -y \
    build-essential \
    curl \
    git \
    libbz2-dev \
    libfreetype6-dev \
    libicu-dev \
    libjpeg-dev \
    libmcrypt-dev \
    libpng-dev \
    libreadline-dev \
    libonig-dev \
    libpq-dev \
    sudo \
    unzip \
    zip \
    nano

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install exif pcntl bcmath gd pdo pdo_pgsql sockets

# Install Redis extentions
RUN pecl install redis \
    && docker-php-ext-enable redis

# add user ubuntu, add group ubuntu
RUN useradd -rm -d /home/ubuntu -s /bin/bash -g root -G sudo,www-data -u 1000 ubuntu
RUN groupadd ubuntu
