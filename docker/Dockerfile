FROM php:8.0.30-apache

# Instalar extensiones PHP
RUN docker-php-ext-install mysqli pdo_mysql \
    && a2enmod rewrite

# Copiar archivos de configuración (rutas relativas al contexto ./docker)
COPY apache-config/ /etc/apache2/sites-available/
COPY php.ini /usr/local/etc/php/conf.d/custom.ini

# Establecer el directorio de trabajo
WORKDIR /var/www/html