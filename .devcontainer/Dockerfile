FROM php:8.2-apache

# Instala extensões do PHP necessárias para MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

WORKDIR /var/www/html