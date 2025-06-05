FROM php:8.2-apache

# Installa estensioni PHP richieste da Laravel
RUN apt-get update && apt-get install -y \
    git unzip zip curl libpng-dev libonig-dev libxml2-dev libzip-dev \
    && docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Abilita mod_rewrite (necessario per Laravel routing)
RUN a2enmod rewrite

# Imposta root su /var/www/html/public
ENV APACHE_DOCUMENT_ROOT /var/www/html/public

# Aggiorna config di Apache per usare la nuova root
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/000-default.conf

# Imposta la directory di lavoro
WORKDIR /var/www/html

# Copia tutti i file del progetto
COPY . .

# Installa Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installa le dipendenze Laravel
RUN composer install --no-dev --optimize-autoloader

# Imposta i permessi corretti su storage e cache
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Imposta i permessi su tutti i file del progetto
RUN chown -R www-data:www-data /var/www/html
