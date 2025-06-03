<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Recipe;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class RecipeType extends AbstractType
{
  public function __construct(private FormListenerFactory $listenerFactory)
  {
  }
  public function buildForm(FormBuilderInterface $builder, array $options): void
  {
    $builder
      ->add('title', TextType::class, [
        'empty_data' => ''
      ])
      ->add('slug', TextType::class, [
        'required' => false
      ])
      ->add('thumbnailFile', FileType::class)
      
      # Pour éviter le problème de requetes n+1, on utilise les "types":EntityType #
        ->add('category', EntityType::class, [
        'class' => Category::class,
        'choice_label' => 'name',
        'expanded'=>false,
      ])
      ->add('content', TextareaType::class, [
        'empty_data' => ''
      ])
      ->add('duration')
      ->add('save', SubmitType::class, [
        'label' => 'Envoyer'//on ajoute notre boutton
      ])
      ->addEventListener(FormEvents::PRE_SUBMIT, $this->listenerFactory->autoSlug('title'))
      ->addEventListener(FormEvents::POST_SUBMIT, $this->listenerFactory->timeStamps());
  }

  public function configureOptions(OptionsResolver $resolver): void
  {
    $resolver->setDefaults([
      'data_class' => Recipe::class,
      'validation_groups' => ['Default', 'Extra']
    ]);
  }
}
