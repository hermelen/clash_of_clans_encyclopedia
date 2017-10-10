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

class GeneralTroopType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder
      ->add('name',                 TextType::class)
      ->add('maxLevel',             IntegerType::class)
      ->add('space',                IntegerType::class, array(
        'required' => false))
      ->add('speed',                IntegerType::class)
      ->add('trainingDuration',     IntegerType::class, array(
        'required' => false))
      ->add('damageType',           EntityType::class, array(
        'class'       => 'HerItemsBundle:DamageType',
        'choice_label'=> 'name',
      ))
      ->add('targetType',           EntityType::class, array(
        'class'       => 'HerItemsBundle:TargetType',
        'choice_label'=> 'name',
      ))
      ->add('targetZone',           EntityType::class, array(
        'class'       => 'HerItemsBundle:TargetZone',
        'choice_label'=> 'name',
      ))
      ->add('barrack',              EntityType::class, array(
        'class'        => 'HerItemsBundle:Barrack',
        'choice_label' => 'level',
        'required'     => false,
        'empty_data'   => '',
        'placeholder'  => 'Caserne Noire ou Héro',
      ))
      ->add('darkBarrack',              EntityType::class, array(
        'class'        => 'HerItemsBundle:DarkBarrack',
        'choice_label' => 'level',
        'required'     => false,
        'empty_data'   => '',
        'placeholder'  => 'Caserne Classique ou Héro',
      ))
      ->add('resource',             EntityType::class, array(
        'class'       => 'HerItemsBundle:Resource',
        'choice_label'=> 'type',
      ))
      ->add('troopType',            EntityType::class, array(
        'class'       => 'HerItemsBundle:TroopType',
        'choice_label'=> 'name',
      ))
      ->add('description',          TextareaType::class)
      ->add('offensiveStrategy',    TextareaType::class, array(
        'required'    => false,)
      ->add('defensiveStrategy',    TextareaType::class, array(
        'required'    => false,)
      ->add('other',                TextareaType::class, array(
        'required'    => false,)
      ->add('save',                 SubmitType::class)
    ;

    // On ajoute une fonction qui va écouter un évènement
    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
      function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
        // On récupère notre objet TownHall sous-jacent
        $generalTroop = $event->getData();

        // Cette condition est importante, on en reparle plus loin
        if (null === $generalTroop) {
          return; // On sort de la fonction sans rien faire lorsque $barrack vaut null
        }
      }
    );
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Her\ItemsBundle\Entity\GeneralTroop'
    ));
  }
}
