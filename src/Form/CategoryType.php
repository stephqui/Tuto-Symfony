<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Event\PostSubmitEvent;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('slug')
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer'])
            ->addEventListener(FormEvents::POST_SUBMIT, $this->attachTimeStamps(...))
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }

    public function attachTimeStamps(PostSubmitEvent $event)
    {
        //On veut remplir les champs de date selon les besoins
        $data = $event->getData();
        if (!($data instanceof Category)) {//On vérifie qu'on utilise on objet de type category, mais
            //en général, ça n'arrive pas
            return;
        }
        $data->setUpdatedAt(new \DateTimeImmutable());
        if (!($data->getId())) {
            $data->setCreatedAt(new \DateTimeImmutable());
        }
    }

}
