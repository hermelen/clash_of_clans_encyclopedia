<?php

namespace Her\ItemsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Her\ItemsBundle\Entity\General;

class LoadGeneral implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Infos générales
    $game=
      array(
        9,//max_laboratory
        12,//max_barrack
        7,//max_dark_barrack
        5,//max_spell_factory
        4//max_dark_spell_factory
      );

      // Création de l'entité General
      $info = new General();
      $info->setMaxLaboratory      ($game[0]);
      $info->setMaxBarrack         ($game[1]);
      $info->setMaxDarkBarrack     ($game[2]);
      $info->setMaxSpellFactory    ($game[3]);
      $info->setMaxDarkSpellFactory($game[4]);


    // On la persiste
    $manager->persist($info);

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}
