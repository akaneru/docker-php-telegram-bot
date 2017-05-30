<?php

require_once realpath(__DIR__.'/../vendor/autoload.php');
require_once realpath(__DIR__.'/../configs/configs.php');

use Longman\TelegramBot\TelegramLog;
use Longman\TelegramBot\Telegram;
use Longman\TelegramBot\Exception\TelegramException;
use Longman\TelegramBot\Exception\TelegramLogException;

try {

    // Enable bot logs
    if( BOT_LOGS_ENABLED ){
        TelegramLog::initErrorLog(realpath(__DIR__ . '/../logs') . '/' . BOT_NAME . '_error.log');
        TelegramLog::initDebugLog(realpath(__DIR__ . '/../logs'). '/' . BOT_NAME . '_debug.log');
        TelegramLog::initUpdateLog(realpath(__DIR__ . '/../logs'). '/' . BOT_NAME . '_update.log');
    }

    // Create Telegram API object
    $telegram = new Telegram(BOT_API_KEY, BOT_NAME);

    // Enable MySQL
    $telegram->enableMySQL([
       'host'     => MYSQL_HOST,
       'user'     => MYSQL_USER,
       'password' => MYSQL_PASSWORD,
       'database' => MYSQL_DATABASE_NAME
    ]);

    // Add commands path containing your commands
    $telegram->addCommandsPath(realpath(__DIR__ . '/Commands'));

    // Handle telegram getUpdate request
    $telegram->handleGetUpdates();

} catch (TelegramException $e) {

    // Log telegram errors
    TelegramLog::error($e);

} catch (TelegramLogException $e) {

    // Log telegram errors
    TelegramLog::error($e);

}
