FROM php:8.2-apache

# Installa estensioni PHP necessarie
RUN apt-get update && apt-get install -y \
    libonig-dev libxml2-dev zip unzip git curl \
    && docker-php-ext-install pdo pdo_mysql mbstring

# Copia i file del progetto
COPY . /var/www/html

# Apache usa /public come root
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Permessi corretti
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Abilita mod_rewrite
RUN a2enmod rewrite

# Permetti uso di .htaccess
RUN sed -i '/<Directory \/var\/www\/>/,/<\/Directory>/ s/AllowOverride None/AllowOverride All/' /etc/apache2/apache2.conf

# Installa Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Installa dipendenze
WORKDIR /var/www/html
RUN composer install --no-dev --optimize-autoloader

# 🔑 CREA .env con tutte le variabili fornite da Render
RUN printenv | grep -v "no_proxy" > .env

# Genera chiave Laravel
RUN php artisan key:generate

# Cache delle configurazioni
RUN php artisan config:cache

RUN tail -n 50 storage/logs/laravel.log || echo "No Laravel log"
