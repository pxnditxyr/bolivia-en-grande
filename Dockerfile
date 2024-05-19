FROM php:8.3-apache as web

RUN apt-get update && apt-get install -y \
    libzip-dev \
    zip \
    libpq-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libonig-dev

RUN apt-get clean && rm -rf /var/lib/apt/lists/*

RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd mysqli pdo_mysql zip

RUN pecl install mailparse && docker-php-ext-enable mailparse

WORKDIR /var/www/html

COPY . /var/www/html

RUN a2enmod rewrite

EXPOSE 80

CMD ["apache2-foreground"]
