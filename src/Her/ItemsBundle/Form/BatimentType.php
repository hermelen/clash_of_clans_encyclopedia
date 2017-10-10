<?php
// src/Her/ItemsBundle/Form/BatimentType.php

namespace Her\ItemsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class BatimentType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder
      ->add('name',                 TextType::class)
      ->add('description',          TextareaType::class)
      ->add('offensiveStrategy',    TextareaType::class, array(
        'required'    => false,)
      ->add('defensiveStrategy',    TextareaType::class, array(
        'required'    => false,)
      ->add('other',                TextareaType::class, array(
        'required'    => false,)
      ->add('maxLevel',             TextType::class)
      ->add('space',                TextType::class)
      ->add('resource',             EntityType::class, array(
        'class'       => 'HerItemsBundle:Resource',
        'choice_label'=> 'type',
      ))
      ->add('townHallAvailabilities',  CollectionType::class, array(
        'entry_type' => TownHallAvailabilityType::class,
      ))
      ->add('save',                 SubmitType::class)
    ;

    // On ajoute une fonction qui va écouter un évènement
    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
      function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
        // On récupère notre objet TownHall sous-jacent
        $batiment = $event->getData();

        // Cette condition est importante, on en reparle plus loin
        if (null === $batiment) {
          return; // On sort de la fonction sans rien faire lorsque $barrack vaut null
        }
      }
    );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Her\ItemsBundle\Entity\Batiment'
    ));
  }
}
