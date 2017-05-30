<?php
/**
 * This file is part of the docker-php-telegram-bot project.
 *
 * (c) Tomaso Neri <tomaso.neri@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Longman\TelegramBot\Commands\UserCommands;

use Longman\TelegramBot\Commands\UserCommand;
use Longman\TelegramBot\Request;

/**
 * User "/help" command
 */
class HelpCommand extends UserCommand
{
    /**
     * @var string
     */
    protected $name = 'help';

    /**
     * @var string
     */
    protected $description = 'Show help';

    /**
     * @var string
     */
    protected $usage = '/help';

    /**
     * @var string
     */
    protected $version = '1.0.0';

    /**
     * Command execute method
     *
     * @return \Longman\TelegramBot\Entities\ServerResponse
     * @throws \Longman\TelegramBot\Exception\TelegramException
     */
    public function execute()
    {
        $message = $this->getMessage();
        $chat_id = $message->getChat()->getId();

        $text  = 'Please choose one:'.PHP_EOL;
        $text .= '/echo <text>'.PHP_EOL;
        $text .= '/markdown';

        $data = [
            'chat_id' => $chat_id,
            'text'    => $text,
        ];

        return Request::sendMessage($data);
    }
}
