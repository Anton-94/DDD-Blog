FROM php:8.2-fpm

RUN apt update && \
    apt-get install -y --no-install-recommends libssl-dev zlib1g-dev curl git unzip netcat libxml2-dev libpq-dev libzip-dev && \
    docker-php-ext-install intl opcache pdo pdo_mysql && \
    pecl install apcu && \
    docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql && \
    docker-php-ext-install -j$(nproc) zip opcache intl pdo_pgsql pgsql bcmath && \
    docker-php-ext-enable apcu pdo_pgsql sodium

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- \
    --install-dir=/usr/bin --filename=composer && chmod +x /usr/bin/composer

RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash \
  && apt install symfony-cli

# Redis
RUN pecl install redis && docker-php-ext-enable redis

# Enable Xdebug
ARG DOCKER_PHP_ENABLE_XDEBUG='off'

RUN if [ "${DOCKER_PHP_ENABLE_XDEBUG}" = "on" ]; then \
      pecl install xdebug && \
      docker-php-ext-enable xdebug; \
      echo "zend_extension=$(find /usr/local/lib/php/extensions/ -name xdebug.so)" > /usr/local/etc/php/conf.d/xdebug.ini && \
      echo "xdebug.remote_enable=on" >> /usr/local/etc/php/conf.d/xdebug.ini && \
      echo "xdebug.remote_autostart=off" >> /usr/local/etc/php/conf.d/xdebug.ini && \
      echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/xdebug.ini && \
      php -m; \
    else \
      echo "Skip xdebug support"; \
    fi

COPY php.ini /usr/local/etc/php

WORKDIR /var/www

EXPOSE 9000
