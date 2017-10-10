<?php

namespace Her\TroopBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Her\TroopBundle\Entity\Troop;
use Her\TroopBundle\Entity\CustomTroop;
use Her\TroopBundle\Entity\Image;

class LoadPekka implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {
    // Infos générales du soldier
    $soldier=
      array(
        'pekka',//name
        'caserne',//barrack
        10,//barrack level
        'toutes',//defenses ressources, toutes?
        'cible unique',//target
        'sol',//sol ou air
        25,//space
        16,//speed
        410,//max_damage SUPPRIMER MES MAX, REMPLACER L INFO PAR BEST LEVEL SOLDIER
        4500,//max_life
        45000,//max_cost
        0,//max_child
        180,//duration
        336,//max_improvement_duration
        8000000,//max_improvement_cost
        738,//max_hit_damage
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

    $image2 = new Image();
    $image2->setFile('images/troop/pekka2.png');

    // On la persiste
    $manager->persist($image2);



    // Infos sdpécifiques du soldier par Level
    $skills = array(
      array(
        1,//level
        0,//labo level
        '',//improvement
        0,//improvement_duration
        240,//damage
        2800,//life
        28000,//cost
        '',//child
        $troop,//troop
        $image1,//image
        432,//hit_damage
        '',//destroyed_collateral
      ),
      array(
        2,//level
        6,//labo level
        3000000,//improvement
        240,//improvement_duration
        270,//damage
        3100,//life
        32000,//cost
        '',//child
        $troop,//troop
        $image2,//image
        486,//hit_damage
        '',//destroyed_collateral
      ),
      array(
        3,//level
        6,//labo level
        6000000,//improvement
        288,//improvement_duration
        310,//damage
        3500,//life
        36000,//cost
        '',//child
        $troop,//troop
        $image2,//image
        558,//hit_damage
        '',//destroyed_collateral
      ),
      array(
        4,//level
        8,//labo level
        7000000,//improvement
        336,//improvement_duration
        360,//damage
        4000,//life
        40000,//cost
        '',//child
        $troop,//troop
        $image2,//image
        648,//hit_damage
        '',//destroyed_collateral
      ),
      array(
        5,//level
        8,//labo level
        8000000,//improvement
        336,//improvement_duration
        410,//damage
        4500,//life
        45000,//cost
        '',//child
        $troop,//troop
        $image2,
        738,//hit_damage
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
