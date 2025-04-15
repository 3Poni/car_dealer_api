FROM php:8.3-fpm

RUN usermod -u 1000 www-data
# Innstall system deps
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev \
    mariadb-client \
    && docker-php-ext-install pdo_mysql mbstring zip exif pcntl bcmath gd

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define working dir
WORKDIR /var/www
COPY --chown=www-data:www-data . .

# Giving permissions
RUN chown -R www-data:www-data /var/www/storage
RUN chown -R www-data:www-data /var/www/bootstrap/

# Enter entrypoint
ENTRYPOINT [ "docker/entrypoint.sh" ]
CMD ["-f","/dev/null"]

