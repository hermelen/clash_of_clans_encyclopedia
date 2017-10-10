<?php
// src/Her/ItemsBundle/Form/SpecialHeroType.php

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
use Her\ItemsBundle\Repository\TroopRepository;


use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
// use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class SpecialHeroType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $general = $options['general'];
    $builder
      ->add('level',  IntegerType::class)
      ->add('damageImprovement',  IntegerType::class, array(
        'required'    => false))
      ->add('lifeImprovement',    IntegerType::class, array(
        'required'    => false))
      ->add('speedImprovement',   IntegerType::class, array(
        'required'    => false))
      ->add('child',              IntegerType::class, array(
        'required'    => false))
      ->add('specialDuration',    IntegerType::class, array(
        'required'    => false))
      ->add('lifePercent',        IntegerType::class, array(
        'required'    => false))
      ->add('maxLifeImprovement', IntegerType::class, array(
        'required'    => false))
      ->add('generalSpecialHero', EntityType::class, array(
        'class'       => 'HerItemsBundle:GeneralSpecialHero',
        'choice_label'=> 'name',
        'disabled'    => true,
      ))
      ->add('heroLevels', EntityType::class, array(
        'by_reference' => false,
        'class'       => 'HerItemsBundle:Troop',
        'choice_label'=> 'level',
        'multiple'    => true,
        'expanded'    => true,
        'query_builder'=> function(TroopRepository $er) use ($general){
          return $er
          ->getHeroLevels($general);
        },
      ))
      ->add('save',                 SubmitType::class)
    ;

    // On ajoute une fonction qui va écouter un évènement
    $builder->addEventListener(
      FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
      function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
        // On récupère notre objet TownHall sous-jacent
        $specialHero = $event->getData();

        // Cette condition est importante, on en reparle plus loin
        if (null === $specialHero) {
          return; // On sort de la fonction sans rien faire lorsque $laboratory vaut null
        }
      }
      // ,
      // FormEvents::PRE_SUBMIT,
      // function(FormEvent $event) {
      //   // $form = $event->getForm();
      //   $data = $event->getData();
      //
      //   // the trick : allow empty selection (reset list)
      //   if(!isset($data['heroLevels'])){
      //     $data['heroLevels'] = [];
      //   }
      //   $event->setData($data);
      // }
    );
  }

    public function buildView(FormView $view, FormInterface $form, array $options)
  {
      $view->vars['general']=$options['general']->getName();
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'Her\ItemsBundle\Entity\SpecialHero',
    ));
    $resolver->setRequired(['general']);
  }
}
