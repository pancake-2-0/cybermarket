FROM php:8.4-apache

WORKDIR /app

# Installa dipendenze di sistema
RUN apt-get update && apt-get install -y \
    unzip \
    zip \
    git \
    curl \
    && rm -rf /var/lib/apt/lists/*

# Installa estensioni PHP necessarie
RUN docker-php-ext-install pdo pdo_mysql exif

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copia il progetto
COPY . .

# Installa dipendenze PHP
RUN composer install --no-dev --optimize-autoloader --no-interaction

# Configura Apache
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT=/app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf

# Permessi
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

EXPOSE 80
