FROM php:8.2-alpine as base
RUN apk --no-cache add --virtual .ext-deps linux-headers \
  && docker-php-source extract \
  && apk --no-cache add --virtual .build-deps $PHPIZE_DEPS \
  && docker-php-ext-install opcache \
  && pecl install xdebug \
  && docker-php-ext-enable xdebug \
  && docker-php-source delete \
  && apk del .ext-deps \
  && apk del .build-deps \
  && apk --no-cache add curl git ca-certificates \
  # composer taken from (https://github.com/geshan/docker-php-composer-alpine)
  && curl -sSL https://getcomposer.org/installer | php -- --install-dir=/usr/bin --filename=composer
