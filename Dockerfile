FROM php:7.4-apache
RUN docker-php-ext-install mysqli && docker-php-ext-enable mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN docker-php-ext-install sockets
RUN docker-php-ext-install bcmath
RUN apt-get update && apt-get upgrade -y
RUN apt-get update && apt-get install -y \
    git \
    curl \
    zip \
    unzip
# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer