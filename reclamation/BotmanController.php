<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

class BotmanController extends AbstractController
{
    #[Route('/botman', name: 'app_botman')]
    public function index(Request $request): Response
    {
        // Load the driver(s) you want to use
        DriverManager::loadDriver(\BotMan\Drivers\Telegram\TelegramDriver::class);

        // Your driver-specific configuration
        $config = [
            'telegram' => [
                'token' => 'YOUR_TELEGRAM_BOT_TOKEN',
            ],
        ];

        // Create an instance
        $botman = BotManFactory::create($config);

        // Give the bot something to listen for.
        $botman->hears('hello', function (BotMan $bot) {
            $bot->reply('Hello yourself.');
        });

        // Handle incoming messages
        $botman->listen();

        // Return a simple response for demonstration purposes
        return new Response('BotMan is listening...');
    }
}