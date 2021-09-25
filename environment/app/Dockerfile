FROM php:8.0.3-fpm-alpine3.13

# Install extensions
COPY --from=mlocati/php-extension-installer:1.2.60 /usr/bin/install-php-extensions /usr/local/bin/
RUN install-php-extensions pdo_mysql gd-2.1.0 redis-5.3.4

# Add user
ARG APP_UID
ARG APP_GID
ENV APP_UID ${APP_UID}
ENV APP_GID ${APP_GID}
RUN addgroup -g $APP_GID app
RUN adduser -u $APP_UID -G app -D -H -s /sbin/nologin app

#
# Copy configs
#
COPY php-fpm.conf /usr/local/etc/php-fpm.conf
COPY www.conf     /usr/local/etc/php-fpm.d/www.conf
COPY php.ini      /usr/local/etc/php/php.ini
COPY crontab      /etc/crontabs/app

WORKDIR /var/www/app
USER app
CMD ["php-fpm"]
