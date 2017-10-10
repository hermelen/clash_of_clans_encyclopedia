<?php

namespace Her\ItemsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Her\ItemsBundle\Repository\TownHallRepository;

class WeaponType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('level',                IntegerType::class)
        ->add('damage',               IntegerType::class, array('required'=>false))
        ->add('damagePerSecond',      IntegerType::class, array('required'=>false))
        ->add('hitDamage',            IntegerType::class, array('required'=>false))
        ->add('collateral',           IntegerType::class, array('required'=>false))
        ->add('life',                 IntegerType::class, array('required'=>false))
        ->add('improvementCost',      IntegerType::class, array('required'=>false))
        ->add('improvementDuration',  IntegerType::class, array('required'=>false))
        ->add('exp',                  IntegerType::class, array('required'=>false))
        ->add('child',                IntegerType::class, array('required'=>false))
        ->add('damageCapacity',       IntegerType::class, array('required'=>false))
        ->add('trainingCost',         IntegerType::class, array('required'=>false))
        ->add('image',                ImageType::class, array(
          'required'     =>false,
        ))
        ->add('generalWeapon',        EntityType::class, array(
          'class'       =>'HerItemsBundle:GeneralWeapon',
          'choice_label'=>'name',
          'disabled'    =>true,
        ))
        ->add('townHall',             EntityType::class, array(
          'class'       =>'HerItemsBundle:TownHall',
          'choice_label'=>'level',
          'query_builder'=> function(TownHallRepository $er){
            return $er
            ->createQueryBuilder('t')
            ->orderBy('t.level', 'ASC');
          },
        ))
        ->add('resource',                EntityType::class, array(
          'class'       =>'HerItemsBundle:Resource',
          'choice_label'=>'type',
          'required'=>false,
          'empty_data'=>'',
        ))
        ->add('save',                 SubmitType::class)
        ;

        $builder->addEventListener(
          FormEvents::PRE_SET_DATA,
          function(FormEvent $event) {
            $weapon = $event->getData();
            if (null === $weapon) {
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
            'data_class' => 'Her\ItemsBundle\Entity\Weapon'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'her_itemsbundle_weapon';
    }


}
