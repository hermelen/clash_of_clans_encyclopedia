<?php
// src/Her/ItemsBundle/Form/TroopType.php

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
use Her\ItemsBundle\Repository\TownHallRepository;

use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;


class TroopType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {

    $builder
      ->add('level',                IntegerType::class)
      ->add('improvementCost',      IntegerType::class)
      ->add('improvementDuration',  IntegerType::class)
      ->add('damage',               IntegerType::class)
      ->add('hitDamage',            IntegerType::class)
      ->add('life',                 IntegerType::class)
      ->add('trainingCost',         IntegerType::class, array(
        'required'    =>false,
      ))
      ->add('healingDuration',      IntegerType::class, array(
        'required'    =>false,
      ))
      ->add('child',                IntegerType::class, array(
        'required'     =>false,
      ))
      ->add('collateral',           IntegerType::class, array(
        'required'     =>false,
      ))
      ->add('image',                ImageType::class, array(
        'required'     =>false,
      ))
      ->add('generalTroop',         EntityType::class, array(
        'class'       => 'HerItemsBundle:GeneralTroop',
        'choice_label'=> 'name',
        'disabled'    =>true,
      ))
      ->add('laboratory',           EntityType::class, array(
        'class'        => 'HerItemsBundle:Laboratory',
        'choice_label' => 'level',
        'required'     => false,
        'empty_data'   => '',
        'placeholder'  => 'aucun:héro',
      ))
      ->add('townHall',             EntityType::class, array(
        'class'        => 'HerItemsBundle:TownHall',
        'choice_label' => 'level',
        'required'     => false,
        'empty_data'   => '',
        'placeholder'  => 'Uniquement pour Héros',
        'query_builder'=> function(TownHallRepository $er){
          return $er
          ->createQueryBuilder('t')
          ->orderBy('t.level', 'ASC');
        },
      ))
      ->add('save',                 SubmitType::class)
    ;

    // On ajoute une fonction qui va écouter un évènement
    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
      function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
        // On récupère notre objet TownHall sous-jacent
        $troop = $event->getData();

        // Cette condition est importante, on en reparle plus loin
        if (null === $troop) {
          return; // On sort de la fonction sans rien faire lorsque $barrack vaut null
        }
      }
    );
  }

  public function buildView(FormView $view, FormInterface $form, array $options)
{
    $view->vars['troopType']=$options['general']->getTroopType();
    $view->vars['name']=$options['general']->getName();
}

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Her\ItemsBundle\Entity\Troop'
    ));
    $resolver->setRequired(['general']);
  }
}
