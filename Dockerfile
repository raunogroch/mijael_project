FROM php:8.0.30-apache
RUN docker-php-ext-install mysqli pdo_mysql \
    && a2enmod rewrite
COPY ./apache-config/ /etc/apache2/sites-available/
RUN a2ensite proyecto.conf
COPY --chown=www-data:www-data ./src /var/www/html