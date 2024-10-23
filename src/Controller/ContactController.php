<?php

namespace App\Controller;

use App\Contact\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $data = new ContactDTO();

        //todo a supprimer
        $data->name = 'John DOE';
        $data->mail = 'john@doe.fr';
        $data->message = 'Message bonjour';

        $formContact = $this->createForm(ContactType::class, $data);
        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            $email = (new TemplatedEmail())
                ->from($data->mail)
                ->to('contact@demo.fr')
                ->subject('Demande de contact')
                ->text($data->message)
                ->htmlTemplate('emails/signup.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'data' => $data,
                ]);
            $mailer->send($email);
            $this->addFlash('success', 'Votre mail a bien été envoyé');
            $this->redirectToRoute('contact');
        }
        return $this->render('contact/contact.html.twig', [
            'controller_name' => 'contactcontroller',
            'formContact' => $formContact
        ]);
    }
}
