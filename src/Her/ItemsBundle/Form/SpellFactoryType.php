<?php

namespace Her\ItemsBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Her\ItemsBundle\Repository\TownHallRepository;
use Her\ItemsBundle\Repository\SpellFactoryRepository;

class SpellFactoryType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('level',              IntegerType::class)
        ->add('life',               IntegerType::class)
        ->add('capacity',           IntegerType::class)
        ->add('improvementCost',    IntegerType::class)
        ->add('improvementDuration',IntegerType::class)
        ->add('speedUpCost',        IntegerType::class)
        ->add('exp',                IntegerType::class)
        ->add('image',                ImageType::class, array(
          'required'     =>false,
        ))
        ->add('townHall',           EntityType::class, array(
          'class'       =>'HerItemsBundle:TownHall',
          'choice_label'=>'level',
          'query_builder'=> function(TownHallRepository $er){
            return $er
            ->createQueryBuilder('t')
            ->orderBy('t.level', 'ASC');
          },
        ))
        ->add('batiment',           EntityType::class, array(
          'class'       => 'HerItemsBundle:Batiment',
          'choice_label'=> 'name',
          'disabled'    =>true,
        ))
        ->add('save',               SubmitType::class)
        ;
        // On ajoute une fonction qui va écouter un évènement
        $builder->addEventListener(
          FormEvents::PRE_SET_DATA,    // 1er argument : L'évènement qui nous intéresse : ici, PRE_SET_DATA
          function(FormEvent $event) { // 2e argument : La fonction à exécuter lorsque l'évènement est déclenché
            // On récupère notre objet TownHall sous-jacent
            $spellFactory = $event->getData();

            // Cette condition est importante, on en reparle plus loin
            if (null === $spellFactory) {
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
            'data_class' => 'Her\ItemsBundle\Entity\SpellFactory'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'her_itemsbundle_spellfactory';
    }


}
