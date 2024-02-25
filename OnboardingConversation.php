<?php
namespace App\Controller;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;


use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

class OnboardingConversation extends Conversation
{
    public function askDatabasePreference()
    {
        $question = Question::create('Do you need a database?')
            ->addButtons([
                Button::create('Yes')->value('yes'),
                Button::create('No')->value('no'),
            ]);

        $this->bot->ask($question, function () {
            $answer = $this->bot->getMessage();
            // Store the answer in the conversation state
            $this->storeConversation(['databasePreference' => $answer->getValue()]);

            $this->say('You selected: ' . $answer->getValue());

            // Perform additional actions or ask more questions based on the answer.
            $this->performAdditionalActions();
        });
    }

    public function performAdditionalActions()
    {
        // Retrieve the stored answer from the conversation state
        $databasePreference = $this->retrieveConversation('databasePreference');

        // Access $databasePreference here or perform other actions.
        if ($databasePreference == 'yes') {
            $this->say('Great! You need a database.');
        } else {
            $this->say('Okay, no database needed.');
        }
    }

    public function run()
    {
        $this->askDatabasePreference();
    }
}
