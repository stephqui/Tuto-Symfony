<?php

namespace App\Form;

use App\Entity\Recipe;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Event\PostSubmitEvent;
use Symfony\Component\Form\Event\PreSubmitEvent;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\String\Slugger\AsciiSlugger;

class RecipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title')
            ->add('slug', TextType::class, [
              'required'=> false
            ])
            ->add('content')
            ->add('duration')
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer'//on peut ajouter notre boutton
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, $this->autoSlug(...))
            ->addEventListener(FormEvents::POST_SUBMIT, $this->attachTimeStamps(...))
        ;
    }
    public function autoSlug(PreSubmitEvent $event):void
    {
        //On met une fonction si le slug est vide lors de l'envoi du formulaire
        $data = $event->getData();//Récupère les infos du formulaire
        if (empty($data['slug'])) {
            $slugger = new AsciiSlugger();
            $data['slug'] = strtolower($slugger->slug($data['title']));
            $event->setData($data);
        }
    }

    public function attachTimeStamps(PostSubmitEvent $event){
      //On veut remplir les champs de date selon les besoins
      $data = $event->getData();
      if(!($data instanceof Recipe)){//On vérifie qu'on utilise on objet de type recipe, mais
        //en général, ça n'arrive pas
        return;
      }
      $data->setUpdatedAt(new \DateTimeImmutable());
      if(!($data->getId())){
        $data->setCreatedAt(new \DateTimeImmutable());
      }
    }
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recipe::class,
        ]);
    }
}
