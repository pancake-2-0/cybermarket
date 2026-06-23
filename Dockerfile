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

# Crea le cartelle richieste da Laravel e imposta permessi
RUN mkdir -p bootstrap/cache storage/framework/sessions storage/framework/views storage/framework/testing storage/logs \
    && chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# Installa dipendenze PHP
RUN COMPOSER_ALLOW_SUPERUSER=1 composer install --no-dev --optimize-autoloader --no-interaction

# Configura Apache
RUN a2dismod mpm_event mpm_worker || true \
    && rm -f /etc/apache2/mods-enabled/mpm_event.load /etc/apache2/mods-enabled/mpm_event.conf /etc/apache2/mods-enabled/mpm_worker.load /etc/apache2/mods-enabled/mpm_worker.conf || true
RUN a2enmod mpm_prefork rewrite
RUN echo 'ServerName localhost' >> /etc/apache2/apache2.conf
ENV APACHE_DOCUMENT_ROOT=/app/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN printf '<Directory "%s">\n    Options Indexes FollowSymLinks\n    AllowOverride All\n    Require all granted\n</Directory>\n' "$APACHE_DOCUMENT_ROOT" >> /etc/apache2/sites-available/000-default.conf
RUN apachectl -t

# Permessi
RUN chown -R www-data:www-data /app/storage /app/bootstrap/cache
RUN chmod -R 775 /app/storage /app/bootstrap/cache

COPY docker-entrypoint.sh /usr/local/bin/docker-entrypoint.sh
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

EXPOSE 80
ENTRYPOINT ["/usr/local/bin/docker-entrypoint.sh"]
