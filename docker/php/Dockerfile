FROM php:7.4-fpm-alpine

ARG TZ

COPY ./docker/php/startup.sh /root

WORKDIR /code

ADD . .

RUN set -eux \ &&
  apk add --no-cache git g++ libtool imagemagick imagemagick-dev composer npm make libzip-dev \ &&
  apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS \ &&
  pecl install imagick \ &&
  docker-php-ext-configure opcache --enable-opcache \ &&
  docker-php-ext-enable imagick \ &&
  docker-php-ext-install opcache bcmath pdo_mysql exif zip \ &&
  apk del autoconf g++ libtool make \ &&
  chmod +x /root/startup.sh

CMD ["/root/startup.sh","php-fpm","-F"]
