FROM php:8.2.7-fpm

USER root

# Install required dependencies
RUN apt-get update && apt-get install -y \
    apt-utils \
    libpq-dev \
    libpng-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    libmagickwand-dev \
    inotify-tools \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*

# Install Node.js and npm
RUN curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs

# Install Imagick extension
RUN pecl install imagick \
    && docker-php-ext-enable imagick

# Replace ImageMagick policy for PDF handling
RUN sed -i 's,<policy domain="coder" rights="none" pattern="PDF" />,<policy domain="coder" rights="read|write" pattern="PDF" />,' /etc/ImageMagick-6/policy.xml

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql \
    && docker-php-ext-install bcmath \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip

# Copy custom php.ini configuration
COPY ./_docker/php/php.ini /usr/local/etc/php/conf.d/php.ini

# Install composer
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN curl -sS https://getcomposer.org/installer | php -- \
    --filename=composer \
    --install-dir=/usr/local/bin

WORKDIR /var/www/api