FROM php:7.3-apache
RUN apt-get update -yqq && \
a2enmod rewrite && \
docker-php-ext-install pdo_mysql
RUN php -r "readfile('https://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY default.conf /etc/apache2/sites-enabled/000-default.conf

WORKDIR /var/www/takeaway

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

EXPOSE 80
