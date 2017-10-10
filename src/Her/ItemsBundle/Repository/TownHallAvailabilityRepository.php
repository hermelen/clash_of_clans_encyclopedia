<?php

namespace Her\ItemsBundle\Repository;

/**
 * TownHallAvailabilityRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TownHallAvailabilityRepository extends \Doctrine\ORM\EntityRepository
{
  public function weaponAvailabilityOrderByTownHallLevel($generalEntity)
  {
    $qb = $this->createQueryBuilder('t');

    $qb
    ->select('t,h')
    ->leftJoin('t.townHall', 'h')
    ->where('t.generalWeapon = :generalWeapon')
    ->setParameter('generalWeapon',$generalEntity)
    ->andWhere('t.number > 0')
    ->orderBy('h.level', 'ASC')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }

  public function batimentAvailabilityOrderByTownHallLevel($generalEntity)
  {
    $qb = $this->createQueryBuilder('t');

    $qb
    ->select('t,h')
    ->leftJoin('t.townHall', 'h')
    ->where('t.batiment = :batiment')
    ->setParameter('batiment',$generalEntity)
    ->andWhere('t.number > 0')
    ->orderBy('h.level', 'ASC')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
  // {
  //   $qb = $this->createQueryBuilder('t');
  //
  //   $qb
  //   ->where('t.generalWeapon = :generalWeapon')
  //   ->setParameter('generalWeapon',$generalEntity)
  //   ->andWhere('t.number > 0')
  //   ->orderBy('t.number', 'ASC')
  //   ;
  //
  //   return $qb
  //     ->getQuery()
  //     ->getResult()
  //   ;
  // }
}
