<?php

namespace App\Controller;


use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class OptionsConversation extends Conversation
{

/**
 * @return mixed 
 */

    public function run()
    {
        // $this->bot->ask('Hi, what is your name?', function($answer) {
        //     $firstName = $answer->getText();
        //     $this->say('Nice to meet you '.$firstName);
        // }) ;
        $this->bot->reply('Okay, ');
    }
}
