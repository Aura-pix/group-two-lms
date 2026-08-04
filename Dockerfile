FROM php:8.2-apache

# Enable mysqli extension
RUN docker-php-ext-install mysqli

# Copy project files into Apache's web root
COPY . /var/www/html/

# Apache listens on 80 by default
EXPOSE 80