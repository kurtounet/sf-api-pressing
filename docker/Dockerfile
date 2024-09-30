# FROM php:8.3-apache

# #RUN docker-php-ext-install mysqli pdo pdo_mysql && docker-php-ext-enable mysqli pdo pdo_mysql 

# # EXPOSE 80
# RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
#   \
#   &&  apt-get update \
#   &&  apt-get install -y --no-install-recommends \
#   locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev unzip \
#   \
#   &&  echo "en_US.UTF-8 UTF-8" > /etc/locale.gen  \
#   &&  echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen \
#   &&  locale-gen \
#   \
#   &&  curl -sS https://getcomposer.org/installer | php -- \
#   &&  mv composer.phar /usr/local/bin/composer \
#   \
#   && curl -sL https://deb.nodesource.com/setup_18.x | bash \
#   && apt-get install nodejs \
#   \
#   &&  curl -sS https://get.symfony.com/cli/installer | bash \
#   &&  mv /root/.symfony/bin/symfony /usr/local/bin \
#   \ 
#   &&  docker-php-ext-configure \
#   intl \
#   &&  docker-php-ext-install \
#   pdo pdo_mysql opcache intl zip calendar dom mbstring gd xsl \
#   \
#   &&  pecl install apcu && docker-php-ext-enable apcu

# WORKDIR /var/www/

FROM php:8.3-apache

ENV DEBIAN_FRONTEND=noninteractive

RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf \
  && apt-get update \
  && apt-get install -y --no-install-recommends \
  locales apt-utils git libicu-dev g++ libpng-dev libxml2-dev libzip-dev libonig-dev libxslt-dev unzip \
  && echo "en_US.UTF-8 UTF-8" > /etc/locale.gen \
  && echo "fr_FR.UTF-8 UTF-8" >> /etc/locale.gen \
  && locale-gen \
  && curl -sS https://getcomposer.org/installer | php -- \
  && mv composer.phar /usr/local/bin/composer \
  && curl -sL https://deb.nodesource.com/setup_18.x | bash \
  && apt-get install -y nodejs \
  && curl -sS https://get.symfony.com/cli/installer | bash \
  && mv /root/.symfony5/bin/symfony /usr/local/bin \
  && docker-php-ext-configure intl \
  && docker-php-ext-install pdo pdo_mysql opcache intl zip calendar dom mbstring gd xsl \
  && pecl install apcu && docker-php-ext-enable apcu
COPY . /var/www
WORKDIR /var/www/

