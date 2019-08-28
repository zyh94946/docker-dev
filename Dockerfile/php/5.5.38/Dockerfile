FROM php:5.5.38-fpm

RUN /bin/echo -e "deb http://mirrors.aliyun.com/ubuntu/ bionic main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic main restricted universe multiverse\ndeb http://mirrors.aliyun.com/ubuntu/ bionic-security main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic-security main restricted universe multiverse\ndeb http://mirrors.aliyun.com/ubuntu/ bionic-updates main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic-updates main restricted universe multiverse\ndeb http://mirrors.aliyun.com/ubuntu/ bionic-proposed main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic-proposed main restricted universe multiverse\ndeb http://mirrors.aliyun.com/ubuntu/ bionic-backports main restricted universe multiverse\ndeb-src http://mirrors.aliyun.com/ubuntu/ bionic-backports main restricted universe multiverse" > /etc/apt/sources.list

RUN apt-get remove binutils -y

# 安装编译所需库
RUN apt-get update && apt-get install -y --force-yes \
        wget \
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
        libxslt-dev \
        libcurl3 \
        librabbitmq-dev \
        libmemcached-dev \
        libtidy-dev \
    && docker-php-ext-install -j$(nproc) gd
RUN /bin/bash -c 'ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h'

# 安装php源码自带扩展
RUN docker-php-ext-install -j$(nproc) bcmath \
    && docker-php-ext-install -j$(nproc) bz2 \
    && docker-php-ext-install -j$(nproc) calendar \
    && docker-php-ext-install -j$(nproc) exif \
    && docker-php-ext-install -j$(nproc) gettext \
    && docker-php-ext-install -j$(nproc) gmp \
    && docker-php-ext-configure imap --with-kerberos --with-imap-ssl \
    && docker-php-ext-install -j$(nproc) imap \
    && docker-php-ext-install -j$(nproc) mcrypt \
    && docker-php-ext-install -j$(nproc) mysql \
    && docker-php-ext-install -j$(nproc) mysqli \
    && docker-php-ext-install -j$(nproc) pcntl \
    && docker-php-ext-install -j$(nproc) pdo_mysql \
    && docker-php-ext-install -j$(nproc) shmop \
    && docker-php-ext-install -j$(nproc) soap \
    && docker-php-ext-install -j$(nproc) sockets \
    && docker-php-ext-install -j$(nproc) sysvmsg \
    && docker-php-ext-install -j$(nproc) sysvsem \
    && docker-php-ext-install -j$(nproc) sysvshm \
    && docker-php-ext-install -j$(nproc) wddx \
    && docker-php-ext-install -j$(nproc) xmlrpc \
    && docker-php-ext-install -j$(nproc) xsl \
    && docker-php-ext-install -j$(nproc) zip \
    && docker-php-ext-install -j$(nproc) tidy

RUN pecl channel-update pecl.php.net

# 从pecl安装扩展
RUN pecl install mongo-1.6.13 \
    && pecl install swoole-1.9.0 \
    && pecl install amqp-1.7.1 \
    && pecl install apcu-4.0.11 \
    && pecl install igbinary-1.2.1 \
    && pecl install memcache-3.0.8 \
    && pecl install memcached-2.2.0 \
    && pecl install msgpack-0.5.7 \
    && pecl install mysqlnd_ms-1.5.2 \
    && docker-php-ext-enable mongo swoole amqp apcu igbinary memcache memcached msgpack mysqlnd_ms

# 安装sphinx所需libsphinxclient
RUN /bin/bash -c 'wget http://sphinxsearch.com/files/sphinx-2.2.11-release.tar.gz' \
    && tar -zxvf sphinx-2.2.11-release.tar.gz \
    && rm -rf sphinx-2.2.11-release.tar.gz \
    && (\
        cd sphinx-2.2.11-release/api/libsphinxclient \
        && ./configure \
        && make \
        && make install \
        && rm -rf sphinx-2.2.11-release \
    )

RUN pecl install sphinx-1.3.3 \
    && docker-php-ext-enable sphinx

RUN apt-get install curl -y --force-yes
RUN apt-get install libcurl4-gnutls-dev -y --force-yes
RUN cd /usr/include && ln -s x86_64-linux-gnu/curl
RUN apt-get install libcurl-openssl1.0-dev libcurl3/bionic -y --force-yes
RUN pecl install yar-1.2.5 \
    && docker-php-ext-enable yar

RUN /bin/bash -c 'wget https://github.com/phpredis/phpredis/archive/2.2.8.tar.gz' \
    && tar -zxvf 2.2.8.tar.gz \
    && rm -rf 2.2.8.tar.gz \
    && (\
        cd phpredis-2.2.8 \
        && phpize \
        && ./configure --enable-redis-igbinary \
        && make \
        && make install \
        && rm -rf phpredis-2.2.8 \
    )

# 自定义配置文件
#COPY amqp.ini /usr/local/etc/php/conf.d/docker-php-ext-amqp.ini
#COPY apcu.ini /usr/local/etc/php/conf.d/docker-php-ext-apcu.ini
#COPY swoole.ini /usr/local/etc/php/conf.d/docker-php-ext-swoole.ini
#COPY yar.ini /usr/local/etc/php/conf.d/docker-php-ext-yar.ini
#COPY php.ini /usr/local/etc/php/
#COPY php-fpm.conf /usr/local/etc/
#COPY www.conf /usr/local/etc/php-fpm.d/





