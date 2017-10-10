<?php

namespace Her\ItemsBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Her\ItemsBundle\Repository\LaboratoryRepository;

class SpellType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('level',              IntegerType::class)
        ->add('damage',             IntegerType::class, array('required'=>false))
        ->add('trainingCost',       IntegerType::class)
        ->add('improvementCost',    IntegerType::class, array('required'=>false))
        ->add('improvementDuration',IntegerType::class, array('required'=>false))
        ->add('health',             IntegerType::class, array('required'=>false))
        ->add('healthPerImpulse',   IntegerType::class, array('required'=>false))
        ->add('damageImprovement',  IntegerType::class, array('required'=>false))
        ->add('speedImprovement',   IntegerType::class, array('required'=>false))
        ->add('actionDuration',     IntegerType::class, array('required'=>false))
        ->add('child',              IntegerType::class, array('required'=>false))
        ->add('damagePerSecond',    IntegerType::class, array('required'=>false))
        ->add('damagePerImpulse',   IntegerType::class, array('required'=>false))
        ->add('speedDecrease',      IntegerType::class, array('required'=>false))
        ->add('attackDecrease',     IntegerType::class, array('required'=>false))
        ->add('lifeDecrease',       IntegerType::class, array('required'=>false))
        ->add('generalSpell',       EntityType::class, array(
          'class'       => 'HerItemsBundle:GeneralSpell',
          'choice_label'=> 'name',
          'disabled'    =>true,
        ))
        ->add('laboratory',       EntityType::class, array(
          'class'        => 'HerItemsBundle:Laboratory',
          'choice_label' => 'level',
          'required'     => false,
          'empty_data'   => '',
          'placeholder'  => 'Aucun',
          'query_builder'=> function(LaboratoryRepository $er){
            return $er
            ->createQueryBuilder('l')
            ->orderBy('l.level', 'ASC');
          },
        ))
        ->add('save',               SubmitType::class)
        ;
        $builder->addEventListener(
          FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
          function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
            // On récupère notre objet TownHall sous-jacent
            $spell = $event->getData();

            // Cette condition est importante, on en reparle plus loin
            if (null === $spell) {
              return; // On sort de la fonction sans rien faire lorsque $barrack vaut null
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
            'data_class' => 'Her\ItemsBundle\Entity\Spell'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'her_itemsbundle_spell';
    }


}
