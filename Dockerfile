FROM php:7.3
LABEL maintainer="Dmitry Zhiltsov <info@zhiltsov.info>"

WORKDIR /app

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/bin/ --filename=composer

RUN curl -sS https://phar.phpunit.de/phpunit-7.phar -L -o phpunit.phar \
    && chmod +x phpunit.phar \
    && mv phpunit.phar /usr/local/bin/phpunit

COPY . /app

RUN composer install --dev

CMD /usr/local/bin/phpunit --bootstrap /app/vendor/autoload.php --no-configuration /app/tests
