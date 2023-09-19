FROM php:8.2-apache

COPY . /var/www/html

RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd mysqli pdo pdo_mysql zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

RUN chown -R www-data:www-data /var/www/html

RUN apt update && apt install -y netcat-traditional

RUN a2enmod rewrite

RUN chmod +x /var/www/html/entrypoint.sh

CMD ["/var/www/html/entrypoint.sh"]