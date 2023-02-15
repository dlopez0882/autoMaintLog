FROM php:7

RUN apt-get update; apt-get install -y wget libzip-dev
RUN docker-php-ext-install zip pdo_mysql
RUN wget https://raw.githubusercontent.com/composer/getcomposer.org/master/web/installer -O - -q | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /app
COPY . /app

RUN composer install

RUN echo "#!/bin/sh\n" \
  "php artisan migrate\n" \
  "php artisan serve --host 0.0.0.0 --port \$PORT" > /app/start.sh

RUN chmod +x /app/start.sh

CMD ["/app/start.sh"]