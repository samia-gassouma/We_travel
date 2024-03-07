<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Include Infobip classes
use Infobip\Configuration;
use Infobip\Api\SendSmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

class SmsController extends AbstractController
{
    /**
     * @Route("/sms", name="app_index")
     */
    public function index(): Response
    {
        // 1. Create configuration object and client
        $baseurl = $this->getParameter("sms_gateway.baseurl");
        $apikey = $this->getParameter("sms_gateway.apikey");
        $apikeyPrefix = $this->getParameter("sms_gateway.apikeyprefix");
        
        $configuration = (new Configuration())
            ->setHost($baseurl)
            ->setApiKeyPrefix('Authorization', $apikeyPrefix)
            ->setApiKey('Authorization', $apikey);

        $client = new \GuzzleHttp\Client();
        $sendSmsApi = new SendSMSApi($client, $configuration);
        
        // 2. Create message object with destination
        $destination = (new SmsDestination())->setTo('21622674745');
        $message = (new SmsTextualMessage())
            // Alphanumeric sender ID length should be between 3 and 11 characters (Example: `CompanyName`). 
            // Numeric sender ID length should be between 3 and 14 characters.
            ->setFrom('InfoSMSsamia')
            ->setText('This is a dummy SMS message sent using infobip-api-php-client')
            ->setDestinations([$destination]);
        
        // 3. Create message request with all the messages that you want to send
        $request = (new SmsAdvancedTextualRequest())->setMessages([$message]);
        
        // 4. Send !
        try {
            $smsResponse = $sendSmsApi->sendSmsMessage($request);
            
            dump($smsResponse);
        } catch (\Throwable $apiException) {
            // HANDLE THE EXCEPTION
            dump($apiException);
        }
        
        
        return new Response("Success (?)");
    }
}