FROM php:8.2-apache

COPY ./php/php.ini /usr/local/etc/php/
COPY ./apache/*.conf /etc/apache2/sites-enabled/

ENV APACHE_DOCUMENT_ROOT /var/www/html/public

RUN apt-get update

# zip unzip install
RUN apt-get -y update && apt-get --no-install-recommends install -y \
    zip \
    unzip \
    vim \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libpq-dev \
    libmcrypt-dev \
    libicu-dev \
    libonig-dev \
    curl \
    gnupg \
    && rm -rf /var/lib/apt/lists/*

# PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg --with-webp \
&& docker-php-ext-install -j$(nproc) gd intl mbstring exif pdo_pgsql pdo_mysql opcache

# composer install
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" \
&& php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;" \
&& php composer-setup.php \
&& mv composer.phar /usr/local/bin/composer

WORKDIR /var/www/html/

RUN a2enmod rewrite

RUN curl -sL https://deb.nodesource.com/setup_18.x | bash -
RUN apt-get install -y nodejs
