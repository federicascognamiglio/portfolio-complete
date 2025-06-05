# Usa un'immagine base con PHP 8.2, Apache e Composer
FROM php:8.2-apache

# Installa le estensioni necessarie per Laravel
RUN apt-get update && apt-get install -y \
    git unzip libpng-dev libonig-dev libxml2-dev zip curl libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Abilita Apache mod_rewrite
RUN a2enmod rewrite

# Imposta la working directory
WORKDIR /var/www/html

# Copia i file nel container
COPY . .

# Installa le dipendenze Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN composer install --no-dev --optimize-autoloader

# Imposta i permessi corretti
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Espone la porta 80
EXPOSE 80
