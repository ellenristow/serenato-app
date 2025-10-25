# Usa imagem oficial do PHP com Apache
FROM php:8.2-apache

# Instala extensões PHP necessárias
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Habilita o mod_rewrite do Apache
RUN a2enmod rewrite

# Instala dependências necessárias para o Composer
RUN apt-get update && apt-get install -y unzip git \
    && rm -rf /var/lib/apt/lists/*

# 🔹 Copia o Composer da imagem oficial para este container
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Define o diretório de trabalho
WORKDIR /var/www/html