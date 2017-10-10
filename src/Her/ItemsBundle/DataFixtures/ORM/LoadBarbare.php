<?php

namespace Her\ItemsBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Her\ItemsBundle\Entity\Troop;
use Her\ItemsBundle\Entity\CustomTroop;
use Her\ItemsBundle\Entity\Image;

class LoadBarbare implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Infos générales du soldier
    $soldier=
      array(
        'barbare',//name
        'caserne',//barrack
        1,//barrack level
        'toutes',//defenses ressources, toutes?
        'cible unique',//target
        'sol',//sol ou air
        1,//space
        16,//speed
        30,//max_damage
        125,//max_life
        250,//max_cost
        0,//max_child
        5,//duration
        336,//max_improvement_duration
        8000000,//max_improvement_cost
        '',//max_hit_damage
        738,//max_destroyed_collateral
      );

      // Création de l'entité Troop
      $troop = new Troop();
      $troop->setName                   ($soldier[0]);
      $troop->setBarrack                ($soldier[1]);
      $troop->setBarrackLevel           ($soldier[2]);
      $troop->setTargetType             ($soldier[3]);
      $troop->setDamageType             ($soldier[4]);
      $troop->setTargetZone             ($soldier[5]);
      $troop->setSpace                  ($soldier[6]);
      $troop->setSpeed                  ($soldier[7]);
      $troop->setMaxDamage              ($soldier[8]);
      $troop->setMaxLife                ($soldier[9]);
      $troop->setMaxCost                ($soldier[10]);
      $troop->setMaxChild               ($soldier[11]);
      $troop->setDuration               ($soldier[12]);
      $troop->setMaxImprovementDuration ($soldier[13]);
      $troop->setMaxImprovementCost     ($soldier[14]);
      $troop->setMaxHitDamage           ($soldier[15]);
      $troop->setMaxCollateral          ($soldier[16]);

      $image1 = new Image();
      $image1->setFile('images/troop/pekka1.png');

      // On la persiste
      $manager->persist($image1);

      // Infos sdpécifiques du soldier par Level
      $skills = array(
        array(
          1,//level
          0,//labo level
          '',//improvement
          '',//improvement_duration hour
          8,//damage
          54,//life
          40,//cost
          '',//child
          $troop,//troop
          $image1,//image
          '',//hit_damage
          '',//destroyed_collateral
        ),
        array(
          2,//level
          1,//labo level
          50000,//improvement
          6,//improvement_duration hour
          11,//damage
          58,//life
          50,//cost
          '',//child
          $troop,//troop
          $image1,//image
          '',//hit_damage
          '',//destroyed_collateral
        ),
      );

      foreach ($skills as $skill) {
        // Création des entités soldier Level
        $customTroop = new CustomTroop();
        $customTroop->setLevel              ($skill[0]);
        $customTroop->setLaboratoryLevel    ($skill[1]);
        $customTroop->setImprovement        ($skill[2]);
        $customTroop->setImprovementDuration($skill[3]);
        $customTroop->setDamage             ($skill[4]);
        $customTroop->setLife               ($skill[5]);
        $customTroop->setCost               ($skill[6]);
        $customTroop->setChild              ($skill[7]);
        $customTroop->setTroop              ($skill[8]);
        $customTroop->setImage              ($skill[9]);
        $customTroop->setHitDamage          ($skill[10]);
        $customTroop->setCollateral         ($skill[11]);

        // On la persiste
        $manager->persist($customTroop);
      }
      // On la persiste
      $manager->persist($troop);

    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}
