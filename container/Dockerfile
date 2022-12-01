FROM php:7.4.19-fpm-alpine

ENV APP_USER ureblock
ENV APP_USER_ID 2000
ENV APP_PATH /usr/src
WORKDIR $APP_PATH

RUN set -eux; \
  apk add --no-cache --virtual .build-deps $PHPIZE_DEPS \
    git \
    libzip-dev \
    oniguruma-dev \
    postgresql-dev \
    supervisor \
    zlib-dev \
  ; \
  rm -rf /tmp/* /var/cache/apk/*;

RUN set -eux; \
  wget https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/msodbcsql17_17.5.1.1-1_amd64.apk && \
  wget https://download.microsoft.com/download/e/4/e/e4e67866-dffd-428c-aac7-8d28ddafb39b/mssql-tools_17.5.1.1-1_amd64.apk && \
  apk add --allow-untrusted msodbcsql17_17.5.1.1-1_amd64.apk && \
  apk add --allow-untrusted mssql-tools_17.5.1.1-1_amd64.apk && \
  apk add --no-cache --virtual .phpize-deps $PHPIZE_DEPS unixodbc-dev && \
  pecl install pdo_sqlsrv && \
  docker-php-ext-enable pdo_sqlsrv && \
  apk del .phpize-deps && \
  rm msodbcsql17_17.5.1.1-1_amd64.apk && \
  rm mssql-tools_17.5.1.1-1_amd64.apk

RUN set -eux; \
  pecl install -o -f \
    redis \
    mongodb \
  ; \
  docker-php-ext-install \
    bcmath \
    mbstring \
    opcache \
    pdo_pgsql \
    zip \
    fileinfo \
  ; \
  docker-php-ext-enable \
    redis \
    mongodb \
    ; \
  rm -fr php.tar.xz php.tar.xz.asc;

RUN set -eux; \
  curl -SL --progress-bar -o /usr/local/bin/phpunit https://phar.phpunit.de/phpunit-6.5.phar; \
  chmod +x /usr/local/bin/phpunit; \
  curl -SL --progress-bar -o /usr/local/bin/composer https://getcomposer.org/composer.phar; \
  chmod +x /usr/local/bin/composer;

RUN set -eux; \
  addgroup --g $APP_USER_ID $APP_USER; \
  adduser -D -u $APP_USER_ID -G $APP_USER -h ${APP_PATH} $APP_USER; \
  mkdir -p ${APP_PATH}/.composer; \
  chown -R ${APP_USER}:${APP_USER} ${APP_PATH}/.composer;

RUN set -eux; \
  apk update; \
  apk add --no-cache \
    nginx \
  ;

RUN set -eux; \
  mkdir -p \
    /var/log/php \
    /run/nginx; \
  chown ureblock:ureblock /var/log/php; \
  chown nginx:nginx /var/log/nginx; \
  ln -sf /dev/stdout /var/log/nginx/access.log; \
  ln -sf /dev/stderr /var/log/nginx/error.log;

COPY www.conf /usr/local/etc/php-fpm.d/www.conf
COPY default.conf /etc/nginx/http.d/default.conf
COPY supervisord.conf /etc/supervisord.conf

USER root
EXPOSE 80

CMD ["supervisord", "-c", "/etc/supervisord.conf"]
