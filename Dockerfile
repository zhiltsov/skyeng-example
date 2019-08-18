FROM php:7.3
LABEL maintainer="Dmitry Zhiltsov <info@zhiltsov.info>"

COPY . /app
WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN composer install --dev

CMD php /app/vendor/bin/phpunit --bootstrap /app/vendor/autoload.php --no-configuration /app/tests
