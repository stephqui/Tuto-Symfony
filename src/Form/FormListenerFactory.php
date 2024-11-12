<?php
//Cette classe générique va générer des Listener (pour le remplissage du formulaire,
//ça remplit un slug si besoin, et les champs date).
//cela évitera de les recopier dans les RecipeType et CategoryType
namespace App\Form;

use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\String\Slugger\AsciiSlugger;

class FormListenerFactory
{
    public function autoSlug(string $field): callable
    //on passe en paramètre le champ $field qui va générer le slug.
    {
        return function (PreSubmitEvent $event) use ($field) {
            //On met une fonction si le slug est vide lors de l'envoi du formulaire
            $data = $event->getData();//Récupère les infos du formulaire
            if (empty($data['slug'])) {
                $slugger = new AsciiSlugger();
                $data['slug'] = strtolower($slugger->slug($data[$field]));
                $event->setData($data);
            }
        };
    }

    public function timeStamps(): callable  
    {
        return function (PostSubmitEvent $event) {
            //On veut remplir les champs de date selon les besoins
            $data = $event->getData();
            $data->setUpdatedAt(new \DateTimeImmutable());
            if (!($data->getId())) {
                $data->setCreatedAt(new \DateTimeImmutable());
            }
        };
    }
}