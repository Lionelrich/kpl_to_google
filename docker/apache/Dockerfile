FROM php:7.2-apache

RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libmcrypt-dev \
        libpng-dev \
        libicu-dev \
        libxml2-dev \
            --no-install-recommends

RUN docker-php-ext-install zip intl mbstring pdo_mysql soap mysqli exif \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install gd
RUN pecl install mcrypt-1.0.2
RUN docker-php-ext-enable mcrypt

COPY kpl.local.conf /etc/apache2/sites-available/

RUN a2ensite kpl.local && a2enmod rewrite

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer

RUN apt-get update && \
    apt-get install git -y

ENV APACHE_RUN_USER layon
RUN useradd -d /var/www --uid=1000 --group=www-data -s /sbin/nologin layon
