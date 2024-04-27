FROM php:8.3-cli

WORKDIR /app
COPY . .
COPY ./.env.production ./.env

RUN apt-get -y update \
&& apt-get install -y git

COPY --from=composer /usr/bin/composer /usr/bin/composer

# Install dependencies without dev related
RUN composer install --no-dev --ignore-platform-reqs

RUN tar czf /tmp/visahack.tar.gz /app

CMD ["tail", "-f", "/dev/null"]




