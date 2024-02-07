FROM dunglas/frankenphp:latest-php8.3-alpine as frankenphp

WORKDIR /app
USER root

RUN apk update --no-cache && apk add --no-cache \
    git \
    acl \
    file \
    gettext \
    openssh-client

# Install PHP extensions
RUN set -eux; \
    install-php-extensions \
        @composer \
        gd \
        apcu \
        intl \
        opcache \
        zip \
    ;

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --link ./docker/Caddyfile /etc/caddy/Caddyfile

HEALTHCHECK --start-period=60s CMD curl -f http://localhost:2019/metrics || exit 1
CMD [ "frankenphp", "run", "--config", "/etc/caddy/Caddyfile" ]

FROM frankenphp as dev

ENV APP_ENV=dev XDEBUG_MODE=off
VOLUME /app/var/

# Install fish shell
ARG XDG_CONFIG_HOME=/home/www-data/.config
ENV XDG_CONFIG_HOME=${XDG_CONFIG_HOME}

ARG XDG_DATA_HOME=/home/www-data/.local/share
ENV XDG_DATA_HOME=${XDG_DATA_HOME}

RUN mkdir -p ${XDG_CONFIG_HOME}/fish
RUN mkdir -p ${XDG_DATA_HOME}

RUN apk add --no-cache \
    fish

# Copy ini files
COPY ./docker/dev/php/php.ini $PHP_INI_DIR/php.ini

# Install Xdebug
RUN set -eux; \
    install-php-extensions \
        xdebug \
    ;

# Install castor
RUN curl "https://github.com/jolicode/castor/releases/latest/download/castor.linux-amd64.phar" -L -o castor.phar && \
    chmod +x castor.phar && \
    mv castor.phar /usr/local/bin/castor

# Init non-root user
ARG USER=www-data

# Remove default user and group
RUN deluser www-data || true
RUN delgroup www-data || true

# Create new user and group with the same id as the host user
RUN addgroup -g 1000 www-data
RUN adduser -D -H -u 1000 -s /bin/bash www-data -G www-data

## Caddy requires an additional capability to bind to port 80 and 443
RUN setcap CAP_NET_BIND_SERVICE=+eip /usr/local/bin/frankenphp
## Caddy requires write access to /data/caddy and /config/caddy
RUN chown -R ${USER}:${USER} /data/caddy && chown -R ${USER}:${USER} /config/caddy

RUN chown -R ${USER}:${USER} /home /app /home/${USER} ${XDG_CONFIG_HOME} ${XDG_DATA_HOME}

CMD [ "frankenphp", "run", "--config", "/etc/caddy/Caddyfile", "--watch" ]

FROM frankenphp as prod

ENV APP_ENV=prod
ENV FRANKENPHP_CONFIG="import worker.Caddyfile"

RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

COPY --link frankenphp/conf.d/app.prod.ini $PHP_INI_DIR/conf.d/
COPY --link frankenphp/worker.Caddyfile /etc/caddy/worker.Caddyfile

# prevent the reinstallation of vendors at every changes in the source code
COPY --link composer.* symfony.* ./
RUN set -eux; \
    composer install --no-cache --prefer-dist --no-dev --no-autoloader --no-scripts --no-progress

# copy sources
COPY --link . ./
RUN rm -Rf frankenphp/

RUN set -eux; \
    mkdir -p var/cache var/log; \
    composer dump-autoload --classmap-authoritative --no-dev; \
    composer dump-env prod; \
    composer run-script --no-dev post-install-cmd; \
    chmod +x bin/console; sync;