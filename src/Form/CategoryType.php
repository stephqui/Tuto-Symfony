<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function __construct(private FormListenerFactory $listenerFactory)
    {
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'empty_data' => ''
            ])
            ->add('slug', TextType::class, [
                'required' => false,
                'empty_data' => ''
            ])
            # Pour éviter le problème de requetes n+1, on utilise les "types":EntityType #
            ->add('recipes', EntityType::class, [
                'class' => Recipe::class,
                'choice_label' => 'title',
                'multiple' => true,
                'expanded'=>true,
                'by_reference' => false,# ça, CA PEUT ETRE UN VERITABLE ENFER A DEBUGUER
                #c'est pour contourner les subtilités des
                #formulaires qui utilisent par défaut les setters, quand on a OneToMany - ManyToMany
                #Il va modifier les propriétés à la volée (ici l'id), et même si on flush, on ne va
                #pas modifier en bdd. En mettant false, il va utiliser les méthodes "add"
                # et "remove"; ce sont ces méthodes qui viennent modifier l'objet lorsqu'il
                #est attaché et mettent le setCategory convenablement#
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Enregistrer'
            ])
            ->addEventListener(FormEvents::PRE_SUBMIT, $this->listenerFactory->autoSlug('name'))
            ->addEventListener(FormEvents::POST_SUBMIT, $this->listenerFactory->timeStamps())
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
