# Docker and php-telegram-bot integration

Docker project for setting up a local development environment to start delevoping Telegram Bots with the [php-telegram-bot](https://github.com/php-telegram-bot/core) library in minutes.

In this environment will be used the official docker images:

- [MariaDB](https://hub.docker.com/_/mariadb/)
- [PHP](https://hub.docker.com/_/php/)

## Pre-requisites

- docker

## Setup

### Create the folder for this project (if you want use docker commands below use the name 'telegram-bot')

    $ mkdir /home/me/telegram-bot
    $ cd /home/me/telegram-bot

### Clone this repository

    $ git clone https://github.com/php-telegram-bot/core

### Choose and set mysql database credentials in the following files (obviously these must be the same in both files)

    docker-compose.yml
    bot/configs/configs.php

### Create the Telegram bot in order to obatin bot name and token from the BotFather

Please follow [official instructions](https://core.telegram.org/bots#6-botfather) to create your bot.

### Set bot name and token in the config file

    bot/configs/configs.php

### Fix folder permission for web and database server logs

    $ chmod 777 -R ./logs

### Build containers

    $ docker-compose up -d

### Install the [php-telegram-bot](https://github.com/php-telegram-bot/core) library and his dependencies

    $ docker exec telegrambot_web-server_1 composer update

### Create database (use the previously selected root password)

    $ docker exec telegrambot_database-server_1 mysql -u root -proot -e "CREATE DATABASE IF NOT EXISTS telegram_bot CHARACTER SET = 'utf8mb4' COLLATE = 'utf8mb4_unicode_520_ci'"

### Grant user (use the previously selected root password)

    $ docker exec telegrambot_database-server_1 mysql -u root -proot -e "GRANT ALL PRIVILEGES ON telegram_bot.* to nonrootuser@'%' IDENTIFIED BY 'non-root-password'"

### Import database structure (use the previously non-root password and username)

    $ docker exec -it telegrambot_web-server_1 bash

    $ mysql -u nonrootuser -pnon-root-password -h database-server telegram_bot < ./vendor/longman/telegram-bot/structure.sql

    $ exit

## Usage

### Run your bot with cli

Through Telegram start a new chat with the bot you have created and type /help.

In the web server docker container we have a crontab that will call the bot-cli file (./bot/src/cli.php) every minutes, so our but will reply to us each minute, but if you want to trigger bot execution you can run the following docker command:

    $ sudo docker exec telegrambot_web-server_1 /usr/local/bin/php /var/www/src/cli.php

### Create your commands

Delete sample commands contained in the ./bot/src/Commands/ path: by default there are already 3 commands 2 of them created by the php-telegram-bot authors and then create your commands as you need.

### Run your bot as webhook

    (todo)

## logs

In the ./bot/logs folder you will find all log's from php-telegram-bot library and in the ./logs folder you will find both the web and database server logs.

## Docker ports

The web server uses the port 4000 and the database server port is not mapped at all.

## Other notice

This little project exists only to provide a development environment.
