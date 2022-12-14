FROM php:7.4-fpm

ARG USERNAME=phpusername
ARG USER_UID=1000
ARG USER_GID=$USER_UID

WORKDIR /var/www

RUN apt-get update && apt-get install -y \
    default-mysql-client \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libpng-dev \
    libicu-dev \
    libsodium-dev \
    libxml2-dev \
    libxslt-dev \
    libzip-dev \
    libmcrypt-dev \
    libjpeg-dev \
    libfreetype6 \
    libfreetype6-dev \
    git vim unzip cron sudo ssh ghostscript pigz acl\
    --no-install-recommends
    
RUN apt-get update && \
    apt-get install -y default-mysql-client \
    libxml2-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6 \
    libfreetype6-dev \
    ssh \
    git \
    ghostscript \
    libzip-dev

RUN docker-php-ext-configure gd --with-jpeg=/usr/include \
    --with-freetype=/usr/include/freetype2 \
    && docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure intl \
    && docker-php-ext-install -j$(nproc) intl

RUN docker-php-ext-install -j$(nproc) \
    opcache \
    bcmath \
    mysqli \
    pdo_mysql \
    soap \
    xsl \
    zip \
    sockets \
    sodium

RUN pecl install -o xdebug \
    && docker-php-ext-enable xdebug

RUN pecl install mcrypt-1.0.4 && docker-php-ext-enable mcrypt

# Install Composer
RUN curl https://getcomposer.org/composer-1.phar -o composer \
    && mv composer /usr/local/bin/composer && chmod 755 /usr/local/bin/composer

# Install NodeJS
RUN curl -sL https://deb.nodesource.com/setup_16.x | bash - \
    && apt-get install -y nodejs

RUN groupadd --gid $USER_GID $USERNAME \
    && useradd -s /bin/bash --uid $USER_UID --gid $USER_GID -m $USERNAME \
    && apt-get update \
    && apt-get install -y sudo wget \
    && echo $USERNAME ALL=\(root\) NOPASSWD:ALL > /etc/sudoers.d/$USERNAME \
    && chmod 0440 /etc/sudoers.d/$USERNAME

RUN apt-get autoremove -y \
    && apt-get clean -y \
    && rm -r /var/lib/apt/lists/*

USER $USERNAME

CMD ["php-fpm"]