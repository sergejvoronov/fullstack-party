FROM php:7.2.2-fpm

WORKDIR /php

# Get composer: https://getcomposer.org/download/
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '93b54496392c062774670ac18b134c3b3a95e5a5e5c8f1a9f115f203b75bf9a129d5daa8ba6a13e2cc8a1da0806388a8') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN ln -s /php/composer.phar /usr/bin/composer

# Install dependencies
RUN apt-get update \
 && apt-get install -y git zip unzip \
 && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN apt-get update \
 && apt-get install -y libzip-dev bash-completion procps nano \
 && docker-php-ext-install -j$(nproc) zip mysqli pdo_mysql \
 && rm -rf /var/lib/apt/lists/*

ENV HOME /code

WORKDIR /code
VOLUME /code
