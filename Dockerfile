FROM php:7.3-apache 

ENV APACHE_DOCUMENT_ROOT=/var/www/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN a2enmod rewrite
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pdo pdo_pgsql 
RUN apt-get -y install git 
RUN apt-get install -y \
    libzip-dev \
    zip \
    && docker-php-ext-install zip

COPY composer.phar /usr/local/bin/composer