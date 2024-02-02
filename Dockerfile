FROM php:8.1-fpm

RUN apt-get update && apt-get install -y \
    git \
    curl \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN apt-get install -y librabbitmq-dev && pecl install amqp
RUN docker-php-ext-enable amqp

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN docker-php-ext-install pdo_mysql bcmath sockets

COPY . /var/www/html

ENV COMPOSER_ALLOW_SUPERUSER=1
RUN composer install --no-scripts

RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000

CMD ["php-fpm"]