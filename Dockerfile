FROM php:8

WORKDIR /app
COPY . /app

RUN echo "#!/bin/sh\n" \
  "php artisan migrate\n" \
  "php artisan serve --host 0.0.0.0 --port \$PORT" > /app/start.sh

RUN chmod +x /app/start.sh

CMD ["/app/start.sh"]