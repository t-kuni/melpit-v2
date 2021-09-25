FROM php:8.0.3-cli-alpine3.13

# Install extensions
COPY --from=mlocati/php-extension-installer:1.2.60 /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql gd-2.1.0 redis-5.3.4

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
    && php composer-setup.php --install-dir=/bin --filename=composer --version=2.1.6 \
    && php -r "unlink('composer-setup.php');"

# Install Node
RUN apk add nodejs npm

# Add user
ARG APP_UID
ARG APP_GID
ENV APP_UID ${APP_UID}
ENV APP_GID ${APP_GID}
RUN addgroup -g $APP_GID app
RUN adduser -u $APP_UID -G app -D app

#
# Copy configs
#
COPY php.ini      /usr/local/etc/php/php.ini

WORKDIR /var/www/app
USER app
CMD ["node --version"]
