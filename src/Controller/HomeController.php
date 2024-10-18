<?php

namespace App\Controller;

use App\Contact\ContactFormDTO;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Messenger\MessageBusInterface;

class HomeController extends AbstractController
{

    #[Route("/", name: "home")]
    public function index(Request $request): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route("/contact", name: "contact")]
    public function contactForm(ContactFormDTO $contactFormDTO){
        $formContact = $this->createForm(ContactType::class,$contactFormDTO);
        dd($formContact);
        return $this->render('contact/contact.html.twig',[
            'formContact' => $formContact
        ]);
    }

    public function manageMail(MessageBusInterface $bus): Response
    {
        // will cause the SmsNotificationHandler to be called
        $bus->dispatch(new ContactFormDTO());

        // ...
        return $this->redirectToRoute('home');
    }
}
