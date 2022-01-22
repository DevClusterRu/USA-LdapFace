FROM php:7.4-fpm

RUN apt-get -y update \
&& apt-get install -y libicu-dev \
&& docker-php-ext-configure intl \
&& docker-php-ext-install intl

RUN docker-php-ext-install \
    bcmath \
    opcache \
    calendar \
    pdo_mysql \
    mysqli

RUN apt-get install -y p7zip \
    p7zip-full \
    unace \
    zip

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN mkdir /var/www/html/writable
#RUN mkdir /var/www/html/bootstrap/cache
WORKDIR /var/www/html/

RUN chown -R www-data:www-data \
        /var/www/html/writable
#        /var/www/html/bootstrap/cache

CMD ["php-fpm"]
