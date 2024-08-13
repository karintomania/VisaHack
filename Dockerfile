FROM php:8.3-apache

ARG UID
ARG GID
 
ENV UID=${UID}
ENV GID=${GID}

RUN a2enmod rewrite \
&& a2ensite 000-default

RUN addgroup --gid ${GID} --system laravel \
  && adduser --ingroup laravel --system  --uid ${UID} --disabled-password laravel 

ENV APACHE_RUN_USER laravel
ENV APACHE_RUN_GROUP laravel

RUN apt-get -y update \
&& apt-get install -y curl libicu-dev gnupg2 unzip git \
&& docker-php-ext-install intl pdo mysqli pdo_mysql \
&& pecl install xdebug

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash - 
RUN apt-get install -y nodejs

COPY --from=composer /usr/bin/composer /usr/bin/composer

USER laravel

CMD apachectl -D FOREGROUND
