<?php
//Un eventsubscriber peut avoir plusieurs méthode et s'abonner à plusieurs evenements

namespace App\EventSubscriber;

use App\Contact\ContactDTO;
use App\Event\ContactRequestEvent;
use SebastianBergmann\Environment\Console;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Mailer\MailerInterface;

class MailingSubscriber implements EventSubscriberInterface
{
    public function __construct(private readonly MailerInterface $mailer)
    {
    }
    public function onContactRequestEvent(ContactRequestEvent $event): void
    {
        /*$data = $event->data;
        $email = (new TemplatedEmail())
            ->from($data->mail)
            ->to($data->message)
            ->subject('Demande de contact')
            ->text($data->message)
            ->htmlTemplate('emails/signup.html.twig')
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                'data' => $data,
            ]);
        $this->mailer->send($email);
        
        echo ('sur le OnContact request event ?');
        dd($event);*/
    }

    public static function getSubscribedEvents(): array
    {
        return [
            ContactRequestEvent::class => 'onContactRequestEvent',
        ];
    }
}
