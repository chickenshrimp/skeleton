FROM ubuntu:latest
LABEL authors="okmay"

# Установка необходимых пакетов
RUN apt-get update && \
    apt-get install -y curl git unzip php php-cli php-xml php-mbstring && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/*
# Установка Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Копирование исходного кода проекта в контейнер
COPY . /var/www/html

# Установка Symfony
RUN curl -sS https://get.symfony.com/cli/installer | bash

# Открытие порта
EXPOSE 8000

# Команда для запуска сервера Symfony
CMD ["php", "/var/www/html/bin/console", "server:start", "0.0.0.0:8000"]