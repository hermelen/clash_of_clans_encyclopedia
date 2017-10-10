<?php

namespace Her\LaboratoryBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Her\ItemsBundle\Entity\Laboratory;
use Her\ItemsBundle\Entity\Image;

class LoadLaboratory implements FixtureInterface
{
  // Dans l'argument de la méthode load, l'objet $manager est l'EntityManager
  public function load(ObjectManager $manager)
  {

    $image1 = new Image();
    $image1->setFile('images/laboratory/labo1.gif');

    $image2 = new Image();
    $image2->setFile('images/laboratory/labo2.gif');

    $image3 = new Image();
    $image3->setFile('images/laboratory/labo3.gif');

    $image4 = new Image();
    $image4->setFile('images/laboratory/labo4.gif');

    $image5 = new Image();
    $image5->setFile('images/laboratory/labo5.gif');

    $image6 = new Image();
    $image6->setFile('images/laboratory/labo6.gif');

    $image7 = new Image();
    $image7->setFile('images/laboratory/labo7.gif');

    $image8 = new Image();
    $image8->setFile('images/laboratory/labo8.gif');

    $image9 = new Image();
    $image9->setFile('images/laboratory/labo9.gif');

    $manager->persist($image1);
    $manager->persist($image2);
    $manager->persist($image3);
    $manager->persist($image4);
    $manager->persist($image5);
    $manager->persist($image6);
    $manager->persist($image7);
    $manager->persist($image8);
    $manager->persist($image9);


    // Infos générales
    $infos=array(
      array(
        1,//level smallint
        500,//life smallint
        25000,//improvement_cost integer
        30,//improvement_duration smallint mn
        42,//xp smallint
        $image1,
      ),
      array(
        2,//level smallint
        550,//life smallint
        50000,//improvement_cost integer
        300,//improvement_duration smallint
        134,//xp smallint
        $image2,
      ),
      array(
        3,//level smallint
        600,//life smallint
        90000,//improvement_cost integer
        720,//improvement_duration smallint
        207,//xp smallint
        $image3,
      ),
      array(
        4,//level smallint
        650,//life smallint
        270000,//improvement_cost integer
        1440,//improvement_duration smallint
        293,//xp smallint
        $image4,
      ),
      array(
        5,//level smallint
        700,//life smallint
        500000,//improvement_cost integer
        2880,//improvement_duration smallint
        415,//xp smallint
        $image5,
      ),
      array(
        6,//level smallint
        750,//life smallint
        1000000,//improvement_cost integer
        5760,//improvement_duration smallint
        587,//xp smallint
        $image6,
      ),
      array(
        7,//level smallint
        800,//life smallint
        2500000,//improvement_cost integer
        7200,//improvement_duration smallint
        657,//xp smallint
        $image7,
      ),
      array(
        8,//level smallint
        850,//life smallint
        4000000,//improvement_cost integer
        8640,//improvement_duration integer
        720,//xp smallint
        $image8,
      ),
      array(
        9,//level smallint
        1070,//life smallint
        6000000,//improvement_cost integer
        10080,//improvement_duration smallint
        777,//xp smallint
        $image9,
      ),
    );


      // Création de l'entité General
      foreach ($infos as $info){
        $labo = new Laboratory();
        $labo->setlevel              ($info[0]);
        $labo->setLife               ($info[1]);
        $labo->setImprovementCost    ($info[2]);
        $labo->setImprovementDuration($info[3]);
        $labo->setXp                 ($info[4]);
        $labo->setImage              ($info[5]);

        // On la persiste
        $manager->persist($labo);
      }



    // On déclenche l'enregistrement de toutes les catégories
    $manager->flush();
  }
}
