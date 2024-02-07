FROM dunglas/frankenphp:latest-php8.3-alpine as frankenphp

USER root

RUN apk update --no-cache && apk add --no-cache \
    git \
    openssh-client

# Install PHP extensions
RUN install-php-extensions \
    gd \
    intl \
    zip \
    opcache

FROM frankenphp as dev

# Install fish shell
ARG XDG_CONFIG_HOME=/home/www-data/.config
ENV XDG_CONFIG_HOME=${XDG_CONFIG_HOME}

ARG XDG_DATA_HOME=/home/www-data/.local/share
ENV XDG_DATA_HOME=${XDG_DATA_HOME}

RUN mkdir -p ${XDG_CONFIG_HOME}/fish
RUN mkdir -p ${XDG_DATA_HOME}

RUN apk add --no-cache \
    fish

# Install composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copy ini files
COPY ./docker/dev/php/php.ini $PHP_INI_DIR/php.ini

# Install Xdebug
RUN install-php-extensions xdebug

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

USER ${USER}

FROM frankenphp as prod
