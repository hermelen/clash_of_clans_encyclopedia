<?php
// src/Her/ItemsBundle/Form/GeneralTroopType.php

namespace Her\ItemsBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Her\ItemsBundle\Repository\GeneralTroopRepository;

class GeneralSpecialHeroType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder
      ->add('name',                 TextType::class)
      ->add('maxLevel',                 IntegerType::class)
      ->add('generalTroop',              EntityType::class, array(
        'class'        => 'HerItemsBundle:GeneralTroop',
        'choice_label' => 'name',
        'required'     => false,
        'empty_data'   => '',
        'placeholder'  => 'aucun',
        'query_builder'=> function(GeneralTroopRepository $er){
          return $er
          ->createQueryBuilder('g')
          ->where('g.troopType = 2');
        },
      ))
      ->add('childTroop', EntityType::class, array(
        'class'       => 'HerItemsBundle:GeneralTroop',
        'choice_label'=> 'name',
        'required'     => false,
        'empty_data'   => '',
        'placeholder'  => 'aucune',
      ))
      ->add('image',                ImageType::class, array(
        'required'     =>false,
      ))
      ->add('description',          TextareaType::class)
      ->add('save',                 SubmitType::class)
    ;

    // On ajoute une fonction qui va écouter un évènement
    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
      function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
        // On récupère notre objet TownHall sous-jacent
        $generalSpecialHero = $event->getData();

        // Cette condition est importante, on en reparle plus loin
        if (null === $generalSpecialHero) {
          return; // On sort de la fonction sans rien faire lorsque $barrack vaut null
        }
      }
    );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Her\ItemsBundle\Entity\GeneralSpecialHero'
    ));
  }
}
