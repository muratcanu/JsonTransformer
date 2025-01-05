# Dockerfile for app service

# Use the official PHP image with FPM
FROM php:8.2-fpm

ARG uid=1000
ARG user=mcan

# Install necessary extensions and dependencies
RUN apt-get update && apt-get install -y \
    nginx \
    git \
    libpq-dev \
    zip \
    unzip \
    curl \
    pkg-config \
    && docker-php-ext-install pdo pdo_pgsql \
    && docker-php-ext-enable pdo_pgsql \
    && pecl install xdebug \
    && docker-php-ext-enable xdebug

# Ensure PHP-FPM runs under the proper user (www-data)
RUN usermod -aG www-data root

# Expose the necessary ports
EXPOSE 80

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

WORKDIR /var/www/jsontransformer

USER $user