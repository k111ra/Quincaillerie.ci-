FROM php:8.1-fpm

# Installer les dépendances nécessaires
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    zip \
    unzip \
    git \
    curl

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer les extensions PHP
RUN docker-php-ext-install pdo_mysql gd

# Copier les fichiers de l'application
WORKDIR /var/www/html
COPY . .

# Donner les permissions correctes
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html/storage

EXPOSE 80

# Démarrer le serveur PHP
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=80"]
