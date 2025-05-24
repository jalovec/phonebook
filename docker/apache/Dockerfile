FROM php:8.2-apache

# Instalace potřebných balíků
RUN apt-get update && apt-get install -y \
    libzip-dev \
    unzip \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    curl \
    git \
    zip \
    libpq-dev \
    libicu-dev \
    libsqlite3-dev \
    libcurl4-openssl-dev \
    libssl-dev \
    nano \
    && docker-php-ext-install pdo pdo_mysql

# Aktivuj Apache moduly
RUN a2enmod rewrite proxy proxy_http

# Nastavení výchozího DocumentRoot
ENV APACHE_DOCUMENT_ROOT /var/www/symfony/public

# Přepiš výchozí apache.conf kvůli DocumentRoot
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
