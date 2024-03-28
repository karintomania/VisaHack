FROM php:8.3-apache

RUN a2enmod rewrite \
&& a2ensite 000-default

RUN apt-get -y update \
&& apt-get install -y libicu-dev gnupg2 unzip git \
&& docker-php-ext-install intl pdo mysqli pdo_mysql \
&& pecl install xdebug

# Installation of Node.js: using NodeSource's setup script to install the latest version
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - && \
    apt-get install -y nodejs
COPY --from=composer /usr/bin/composer /usr/bin/composer

CMD apachectl -D FOREGROUND
