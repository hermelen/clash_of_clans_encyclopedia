<?php

namespace Her\ItemsBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;

class TownHallAvailabilityType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('townHall',     EntityType::class, array(
          'class'        => 'HerItemsBundle:TownHall',
          'choice_label' => 'level',
          'disabled'     => true,
        ))
        ->add('number',       IntegerType::class);

        $builder->addEventListener(
          FormEvents::PRE_SET_DATA,function(FormEvent $event) {
            $townHallAvailability = $event->getData();

            if (null === $townHallAvailability) {
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
            'data_class' => 'Her\ItemsBundle\Entity\TownHallAvailability'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'her_itemsbundle_townhallavailability';
    }


}
