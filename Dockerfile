FROM php:8.3-apache

# dependências recomendadas de desenvolvido para ambiente linux
RUN apt-get update && apt-get install -y \
    zlib1g-dev \
    libzip-dev \
    unzip \
    libpng-dev \
    libpq-dev \
    libxml2-dev \
    nodejs \
    npm \
    chromium

RUN docker-php-ext-install mysqli pdo pdo_mysql pdo_pgsql pgsql session xml zip iconv simplexml pcntl gd fileinfo sockets

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

RUN a2enmod rewrite

WORKDIR /var/www/html/

COPY . .

RUN composer install --no-dev --no-interaction && npm install && npm run build

RUN rm node_modules -rf && rm -rf public/hot && npm install --production

EXPOSE 80

RUN chown -R www-data:www-data /var/www/html/storage

ENV APP_NAME Affiliatz
ENV APP_ENV local
ENV APP_DEBUG false
ENV APP_TIMEZONE UTC
ENV APP_URL http://localhost
ENV APP_KEY ''
ENV APP_LOCALE pt
ENV APP_FALLBACK_LOCALE en
ENV DB_CONNECTION mysql
ENV DB_HOST ''
ENV DB_PORT 3306
ENV DB_DATABASE ''
ENV DB_USERNAME ''
ENV DB_PASSWORD ''

