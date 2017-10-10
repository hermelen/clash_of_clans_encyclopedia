<?php

namespace Her\ItemsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class GeneralWeaponType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',                    TextType::class)
        ->add('defense',                 EntityType::class, array(
          'class'       =>'HerItemsBundle:Defense',
          'choice_label'=>'name',
        ))
        ->add('maxLevel',                IntegerType::class)
        ->add('space',                   IntegerType::class)
        ->add('speed',                   IntegerType::class, array('required'=>false))
        ->add('damageArea',              NumberType::class, array('required'=>false))
        ->add('activationArea',          NumberType::class, array('required'=>false))
        ->add('damageType',              EntityType::class, array(
          'class'       =>'HerItemsBundle:DamageType',
          'choice_label'=>'name',
        ))
        ->add('targetZone',              EntityType::class, array(
          'class'       =>'HerItemsBundle:TargetZone',
          'choice_label'=>'name',
        ))
        ->add('resource',                EntityType::class, array(
          'class'       =>'HerItemsBundle:Resource',
          'choice_label'=>'type',
        ))
        ->add('townHallAvailabilities',  CollectionType::class, array(
          'entry_type' => TownHallAvailabilityType::class,
        ))
        ->add('description',          TextareaType::class)
        ->add('save',                    SubmitType::class);

        $builder->addEventListener(
          FormEvents::PRE_SET_DATA,function(FormEvent $event) {
            $generalWeapon = $event->getData();

            if (null === $generalWeapon) {
              return;
            }
          }
        );
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Her\ItemsBundle\Entity\GeneralWeapon'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'her_itemsbundle_generalweapon';
    }


}
