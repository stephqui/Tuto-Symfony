<?php

namespace App\Controller;

use App\Contact\ContactDTO;
use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contact(Request $request, MailerInterface $mailer): Response
    {
        $data = new ContactDTO();

        //todo a supprimer
        $data->name = 'John DOE';
        $data->mail = 'john';
        $data->message = 'Message bonjour';

        $formContact = $this->createForm(ContactType::class, $data);
        $formContact->handleRequest($request);
        if ($formContact->isSubmitted() && $formContact->isValid()) {
            //envoyer email
            $email = (new TemplatedEmail())
                ->from($data->mail)
                ->to('contact@demo.fr')
                ->subject('Demande depuis le site localhost:8000')
                ->text($data->message)
                ->htmlTemplate('contact/signup.html.twig')
                ->context([
                    'expiration_date' => new \DateTime('+7 days'),
                    'name' => $data->name,
                ])
            ;
            $mailer->send($email);

        }
        return $this->render('contact/contact.html.twig', [
            'formContact' => $formContact,
            'name'=>$data->name,
            'email'=>$data->mail
        ]);
    }
}
