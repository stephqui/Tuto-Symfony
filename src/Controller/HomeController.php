<?php

namespace App\Controller;

use App\Contact\ContactFormDTO;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{

    #[Route("/", name: "home")]
    public function index(Request $request): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route("/contact", name: "contact")]
    public function contact(ContactFormDTO $contactFormDTO){
        $formContact = $this->createForm(ContactType::class,$contactFormDTO);
        return $this->render('contact/contact.html.twig',[
            'formContact' => $formContact
        ]);
    }
}
