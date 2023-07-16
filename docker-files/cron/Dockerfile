FROM php:8.2-fpm-alpine

# Install dependencies
RUN apk update && apk add --no-cache \
    postgresql-dev \
    curl \
    nano

# Install PHP extensions
RUN docker-php-ext-install pdo_pgsql

# Create a cron job file
RUN touch /var/log/cron.log
COPY docker-files/cron/config/crontab /etc/crontabs/root

# Start the cron service
CMD ["crond", "-f"]
