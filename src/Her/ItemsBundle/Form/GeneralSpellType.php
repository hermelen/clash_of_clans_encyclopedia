<?php

namespace Her\ItemsBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Her\ItemsBundle\Repository\SpellFactoryRepository;

class GeneralSpellType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name',                 TextType::class)
        ->add('maxLevel',             IntegerType::class)
        ->add('damageArea',           IntegerType::class)
        ->add('randomDamageArea',     NumberType::class, array('required'=>false))
        ->add('space',                IntegerType::class)
        ->add('trainingDuration',     IntegerType::class)
        ->add('actionDuration',       IntegerType::class, array('required'=>false))
        ->add('impulseNumber',        IntegerType::class, array('required'=>false))
        ->add('impulseDuration',      NumberType::class, array('required'=>false))
        ->add('cloneDuration',        IntegerType::class, array('required'=>false))
        ->add('child',                IntegerType::class, array('required'=>false))
        ->add('targetType',           EntityType::class, array(
          'class'       => 'HerItemsBundle:TargetType',
          'choice_label'=> 'name',
          'required'     => false,
          'empty_data'   => '',
          'placeholder'  => 'indifférent',
        ))
        ->add('spellFactory',         EntityType::class, array(
          'class'        =>'HerItemsBundle:SpellFactory',
          'choice_label' =>'level',
          'query_builder'=> function(SpellFactoryRepository $er){
            return $er
            ->createQueryBuilder('s')
          //   ->where('s.batiment = :classicFactory')
          //   ->setParameter('classicFactory',$classicFactory)
            ->addOrderBy('s.batiment', 'ASC')
            ->addOrderBy('s.level', 'ASC')
            ;
          },
        ))
        ->add('resource',             EntityType::class, array(
          'class'        => 'HerItemsBundle:Resource',
          'choice_label' => 'type',
        ))
        ->add('image',                ImageType::class, array(
          'required'     =>false,
        ))
        ->add('description',          TextareaType::class)
        ->add('save',                 SubmitType::class)
        ;
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Her\ItemsBundle\Entity\GeneralSpell'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'her_itemsbundle_generalspell';
    }


}
