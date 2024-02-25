<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\UtilisateurRepository;

use BotMan\BotMan\Cache\SymfonyCache;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;

use App\Controller\OptionsConversation;
use BotMan\BotMan\Messages\Conversations\Conversation;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Cache\CodeIgniterCache;

use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;
use BotMan\BotMan\Middleware\ApiAi;

use App\Controller\OnboardingConversation;
class BotmanController extends AbstractController
{
    #[Route('/bot/{id}', name: 'app_botman')]
    public function index($id,UtilisateurRepository $uR): Response
    {
        $user=$uR->find($id);
        $name=$user->getPrenom();
  
        return $this->render('botman/index.html.twig', [
            'name'=>$name,
            'id' => $id
        ]);
    }

    #[Route('/botman', name: 'app_botman1')]
    public function index1(): Response
    {
        

  
        return $this->render('botman/chat.html.twig', [
        ]);
    }


    #[Route('/chat/{id}', name: 'app_chat')]
    public function index2($id,UtilisateurRepository $uR)
    {

$config = [
    'conversation_cache_time' => 40,

    'user_cache_time' => 30,
    'matchingData' => [
        'driver' => 'web',
    ],
];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);

$adapter = new FilesystemAdapter();

$botman = BotManFactory::create($config);



$botman->hears('Hello', function($bot) {
    $bot->startConversation(new OnboardingConversation,WebDriver::class);
    
});


// Start listening
$botman->listen();


$response = new Response();
    
    // Any code modifying the Response object

    return $response;

    }
}

?>