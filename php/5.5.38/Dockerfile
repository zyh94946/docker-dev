FROM php:5.5.38-fpm

RUN /bin/echo -e "deb http://mirrors.aliyun.com/ubuntu/ bionic main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic main restricted universe multiverse\ndeb http://mirrors.aliyun.com/ubuntu/ bionic-security main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic-security main restricted universe multiverse\ndeb http://mirrors.aliyun.com/ubuntu/ bionic-updates main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic-updates main restricted universe multiverse\ndeb http://mirrors.aliyun.com/ubuntu/ bionic-proposed main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic-proposed main restricted universe multiverse\ndeb http://mirrors.aliyun.com/ubuntu/ bionic-backports main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic-backports main restricted universe multiverse" > /etc/apt/sources.list

RUN apt-get remove binutils -y

RUN apt-get update && apt-get install -y --force-yes \
        build-essential \
        libfreetype6-dev \
        libpng-dev \
        libssl-dev \
        libbz2-dev \
        libgmp-dev \
        libc-client-dev \
        libkrb5-dev \
        libmcrypt-dev \
        libreadline-dev \
        libxml2-dev \
    && docker-php-ext-install -j$(nproc) gd

RUN /bin/bash -c 'ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h'

RUN docker-php-ext-install -j$(nproc) bcmath \
    && docker-php-ext-install -j$(nproc) bz2 \
    && docker-php-ext-install -j$(nproc) calendar \
    && docker-php-ext-install -j$(nproc) exif \
    && docker-php-ext-install -j$(nproc) gettext \
#    && docker-php-ext-configure gmp --with-gmp=/usr/include/x86_64-linux-gnu/gmp.h \
    && docker-php-ext-install -j$(nproc) gmp \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install -j$(nproc) imap \
    && docker-php-ext-install -j$(nproc) mcrypt \
    && docker-php-ext-install -j$(nproc) mysql \
    && docker-php-ext-install -j$(nproc) mysqli \
    && docker-php-ext-install -j$(nproc) pcntl \
    && docker-php-ext-install -j$(nproc) pdo \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
#    && docker-php-ext-install -j$(nproc) phar \
    && docker-php-ext-install -j$(nproc) shmop \
    && docker-php-ext-install -j$(nproc) simplexml \
    && docker-php-ext-install -j$(nproc) soap \
    && docker-php-ext-install -j$(nproc) sockets \
    && docker-php-ext-install -j$(nproc) spl \
    && docker-php-ext-install -j$(nproc) sysvmsg \
    && docker-php-ext-install -j$(nproc) sysvsem \
    && docker-php-ext-install -j$(nproc) sysvshm \
    && docker-php-ext-install -j$(nproc) wddx \
    && docker-php-ext-install -j$(nproc) xmlrpc \
    && docker-php-ext-install -j$(nproc) xsl \
    && docker-php-ext-install -j$(nproc) zip

RUN apt-get install librabbitmq-dev -y --force-yes

RUN pecl channel-update pecl.php.net

RUN pecl install mongo-1.6.13 \
    && pecl install redis-2.2.8 \
    && pecl install swoole-1.9.0 \
    && pecl install amqp-1.7.1 \
    && pecl install apcu-4.0.11 \
    && pecl install igbinary-1.2.1 \
    && pecl install memcache-3.0.8 \
    && pecl install memcached-2.2.0 \
    && pecl install msgpack-0.5.7 \
    && pecl install mysqlnd_ms-1.5.2 \
    && pecl install sphinx-1.3.3 \
    && pecl install yar-1.2.5 \
    && docker-php-ext-enable mongo redis swoole amqp apcu igbinary memcache memcached msgpack mysqlnd_ms sphinx yar

#RUN docker-php-source extract; \
#    cd /usr/src/php/ext; \
#
#    && docker-php-source delete

