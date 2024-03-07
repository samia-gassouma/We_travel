<?php

namespace App\Controller;

use App\Entity\Reclamation;
use Symfony\Component\Notifier\Message\EmailMessage;
use Symfony\Component\Notifier\Notification\EmailNotificationInterface;
use Symfony\Component\Notifier\Notification\Notification;
use Symfony\Component\Notifier\Recipient\EmailRecipientInterface;

class Notifications123 extends Notification implements EmailNotificationInterface
{
    public function __construct(
        private Reclamation $comment,
    ) {
        parent::__construct('New comment posted');
    }

    public function asEmailMessage(EmailRecipientInterface $recipient, string $transport = null): ?EmailMessage
    {
        $message = EmailMessage::fromNotification($this, $recipient, $transport);
        $message->getMessage()
           // ->htmlTemplate('emails/comment_notification.html.twig')
            ->context(['comment' => $this->comment])
            ->from('gassouma530@gmail.com')
        ;

        return $message;
    }
}