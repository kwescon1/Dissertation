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

# Install PHP extensions
RUN docker-php-ext-install pcntl pdo_pgsql

# Install redis extensions
RUN pecl install redis \
    && docker-php-ext-enable redis


# # add user ubuntu, add group ubuntu
# RUN useradd -rm -d /home/ubuntu -s /bin/bash -g root -G sudo,www-data -u 1000 ubuntu
# RUN groupadd ubuntu


# Get latest Composer
# COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/local/bin --filename=composer


# install nodejs
# RUN curl -sL https://deb.nodesource.com/setup_14.x -o nodesource_setup.sh
# RUN bash nodesource_setup.sh
# RUN apt-get update && apt-get install -y \
#     nodejs \
#     yarn \
#     && rm -rf /var/lib/apt/lists/*

# RUN rm nodesource_setup.sh

ENTRYPOINT ["docker-files/composer/entrypoint.sh"]