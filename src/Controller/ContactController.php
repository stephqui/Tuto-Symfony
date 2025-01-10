<?php

namespace App\Controller;

use App\Contact\ContactDTO;
use App\Event\ContactRequestEvent;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer, EventDispatcherInterface $dispatcher): Response
    {
        $data = new ContactDTO();

        $formContact = $this->createForm(ContactType::class, $data);
        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $dispatcher->dispatch(new ContactRequestEvent($data));
            /*
            try {
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
                $mailer->send($email);
                $this->addFlash('success', 'Votre mail a bien été envoyé');
                return $this->redirectToRoute('contact');
            } catch (\Exception $e) {
                $this->addFlash('danger', 'Impossible d\'envoyer votre mail');
            }
            */
        }
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'contactcontroller',
            'formContact' => $formContact
        ]);
    }
}
