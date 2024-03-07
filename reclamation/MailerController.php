<?php

namespace App\Controller;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mailer\Transport;
use Symfony\Component\Mime\Mailer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;

class MailerController extends AbstractController
{
    #[Route('/email')]
    public function sendEmail(MailerInterface $mailer): Response
    {

        $email = (new Email())
            ->from('gassouma530@gmail.com')
            ->to('gassouma.samia@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->text('See Twig integration for better HTML integration!');
            $x="hello";
            try {
                $result = $mailer->send($email);
                // Check $result for the number of successfully sent messages
            } catch (\Exception $e) {
                // Log or handle the exception
                dump($e->getMessage());
            }
            
            
            return $this->render('index/blank.html.twig', [
                'x'=>$x
            ]);

        // use an array if you want to add a header with multiple values
        // (for example in the "References" or "In-Reply-To" header)



        // ...
    }
}
