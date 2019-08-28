FROM php:7.3.8-cli

RUN pecl channel-update pecl.php.net

# 从pecl安装扩展
RUN pecl install swoole-4.4.0 \
    && docker-php-ext-enable swoole
