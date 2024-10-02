# FROM php:8.3-apache

# # Add PHP Extension Installer
# ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# # Install PHP Extensions
# RUN chmod +x /usr/local/bin/install-php-extensions && \
#   install-php-extensions pdo pdo_mysql opcache intl zip calendar dom mbstring gd xsl

# # Install Composer securely
# RUN curl -sS https://getcomposer.org/installer -o composer-setup.php && \
#   EXPECTED_SIGNATURE=$(curl -sS https://composer.github.io/installer.sig) && \
#   php -r "if (hash_file('SHA384', 'composer-setup.php') !== trim('$EXPECTED_SIGNATURE')) { echo 'Installer corrupt'; unlink('composer-setup.php'); exit(1); }" && \
#   php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
#   rm composer-setup.php

# # Install Node.js and NPM from NodeSource (Node.js version 16)
# RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - && \
#   apt-get install -y nodejs

# # Enable Apache Rewrite Module
# #RUN a2enmod rewrite

# # Set working directory to /var/www/
# WORKDIR /var/www/

# # Copy application code to the container
# COPY . /var/www/

# # Set correct permissions for Apache
# RUN chown -R www-data:www-data /var/www/

# # Install dependencies with Composer
# #RUN composer install --no-interaction --optimize-autoloader --no-dev || echo "No composer.json found"

# # Optional: Install NPM dependencies and build assets (uncomment if needed)
# # RUN npm install --force && npm run build

# # Make the startup script executable (optional if you use a startup script)
# #RUN if [ -f ./docker/docker.sh ]; then chmod +x ./docker/docker.sh; fi

# # Set the entrypoint (optional if you use a startup script)
# #ENTRYPOINT ["./docker/docker.sh"]

# # Expose port 80
# EXPOSE 80
# FROM php:8.3-apache

# # Enable Apache Rewrite Module
# RUN a2enmod rewrite

# # Set working directory
# WORKDIR /var/www/

# # Copy application code to the container
# COPY . /var/www/

# # Install Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # Install dependencies with Composer if composer.json exists
# RUN if [ -f composer.json ]; then composer install --no-interaction --optimize-autoloader --no-dev; else echo "No composer.json found, skipping composer install"; fi

# # Make docker.sh executable (if exists)
# RUN if [ -f /var/www/docker/docker.sh ]; then chmod +x /var/www/docker/docker.sh; fi

# # Set the entrypoint to docker.sh
# ENTRYPOINT ["/var/www/docker/docker.sh"]

# # Expose port 80
# EXPOSE 80
# FROM php:8.3-apache

# ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# RUN chmod +x /usr/local/bin/install-php-extensions && \
#   install-php-extensions pdo pdo_mysql opcache intl zip

# RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
#   mv composer.phar /usr/local/bin/composer

# RUN apt update && apt install -yqq nodejs npm default-mysql-client

# COPY . /var/www/

# COPY ./docker/vhosts.conf /etc/apache2/sites-available/000-default.conf

# RUN cd /var/www && \
#   composer install --no-interaction --optimize-autoloader
# # && 
# # npm install --force && \
# # npm run build

# WORKDIR /var/www/

# # ENTRYPOINT ["bash", "./docker/docker.sh"]

# EXPOSE 80
# FROM php:8.3-apache

# # Ajouter l'installeur d'extensions PHP
# ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# # Installer les extensions PHP nécessaires
# RUN chmod +x /usr/local/bin/install-php-extensions && \
#   install-php-extensions pdo pdo_mysql opcache intl zip

# # Installer Composer
# RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
#   mv composer.phar /usr/local/bin/composer

# # Mise à jour des paquets et installation de Node.js, npm et MySQL client
# RUN apt update && apt install -yqq nodejs npm default-mysql-client

# # Activer le module rewrite d'Apache
# RUN a2enmod rewrite

# # Copier la configuration Apache
# COPY ./vhosts.conf /etc/apache2/sites-available/000-default.conf

# # Copier le code source dans le conteneur
# COPY . /var/www/
# # Définir le répertoire de travail
# WORKDIR /var/www/
# # Installer les dépendances PHP avec Composer
# RUN cd /var/www && \
#   composer install --no-interaction --optimize-autoloader





# # Exposer le port 80
# EXPOSE 80
# FROM php:8.3-apache

# # Ajouter l'installeur d'extensions PHP
# ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

# # Installer les extensions PHP nécessaires
# RUN chmod +x /usr/local/bin/install-php-extensions && \
#   install-php-extensions pdo pdo_mysql opcache intl zip

# # Mise à jour des paquets et installation de Node.js, npm et MySQL client
# RUN apt update && apt install -yqq nodejs npm default-mysql-client

# # Activer le module rewrite d'Apache
# RUN a2enmod rewrite

# # Copier la configuration Apache
# COPY vhosts.conf /etc/apache2/sites-available/000-default.conf

# # Copier le code source dans le conteneur
# COPY ../ /var/www/

# # Définir le répertoire de travail
# WORKDIR /var/www/

# # Installer Composer
# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer 

# RUN curl -sS https://get.symfony.com/cli/installer | bash \


# # Installer les dépendances PHP avec Composer, si composer.json existe
# RUN if [ -f /var/www/composer.json ]; then composer install --no-interaction --optimize-autoloader; else echo "No composer.json found, skipping composer install"; fi

# # Exposer le port 80
# EXPOSE 80
# FROM php:8.3-apache

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
# FROM php:8.3-apache

# RUN apt-get update \
#   &&  apt-get install -y zlib1g-dev g++ git libicu-dev zip libzip-dev \
#   &&  pecl install apcu \
#   &&  docker-php-ext-install intl opcache pdo pdo_mysql \
#   &&  docker-php-ext-enable apcu \
#   &&  docker-php-ext-configure zip \
#   &&  docker-php-ext-install zip

# RUN a2enmod rewrite

# WORKDIR /var/www

# RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# # RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
# # RUN apt-get install -y nodejs
# # RUN npm install --force && npm run build

# RUN curl -sS https://get.symfony.com/cli/installer | bash

# RUN mv /root/.symfony5/bin/symfony /usr/local/bin

FROM php:8.3-apache

# Mise à jour et installation des dépendances nécessaires
RUN apt-get update \
  && apt-get install -y --no-install-recommends \
  zlib1g-dev g++ git libicu-dev zip libzip-dev \
  locales apt-utils libpng-dev libxml2-dev libxslt-dev libonig-dev \
  && pecl install apcu \
  && docker-php-ext-install intl opcache pdo pdo_mysql zip \
  && docker-php-ext-enable apcu \
  && a2enmod rewrite \
  && docker-php-ext-configure zip \
  && docker-php-ext-install zip \
  && apt-get clean \
  && rm -rf /var/lib/apt/lists/*

# Configuration Apache
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Définir le répertoire de travail
WORKDIR /var/www

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Installer Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash \
  && mv /root/.symfony*/bin/symfony /usr/local/bin

# Exposer le port 80
EXPOSE 80
