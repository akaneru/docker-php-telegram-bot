FROM php:7.1.5-apache

# nano for editing
RUN apt-get update && apt-get -y --force-yes install nano
RUN echo 'export TERM=xterm' >> $HOME/.bashrc

# icu, needed for the intl extension
RUN apt-get update && apt-get -y install libicu52 libicu-dev zlib1g-dev

# additionals php7 extensions
RUN docker-php-ext-install intl mysqli pdo_mysql zip

# enable apache mod rewrite
RUN a2enmod rewrite

# update the default apache config file
ADD default.conf /etc/apache2/sites-enabled/000-default.conf

# htop for monitoring
RUN apt-get update && apt-get -y --force-yes install htop

# crontab
RUN apt-get update && apt-get -y --force-yes install cron

# mysql client
RUN apt-get update && apt-get -y install mysql-client-5.5

# git
RUN apt-get update && apt-get -y install git

# composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# add the daemons configuration file
RUN mkdir /home/bot
ADD cron.txt /home/bot/cron.txt
RUN crontab -u root /home/bot/cron.txt

# start script
ADD start.sh /home/bot/start.sh
CMD ["/bin/bash", "/home/bot/start.sh"]
