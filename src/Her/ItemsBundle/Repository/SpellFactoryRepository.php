<?php

namespace Her\ItemsBundle\Repository;

/**
 * SpellFactoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SpellFactoryRepository extends \Doctrine\ORM\EntityRepository
{
  public function orderByTypeAndLevel($batiment)
  {
    $qb = $this->createQueryBuilder('s');

    $qb
    ->where('s.batiment = :batiment')
    ->setParameter('batiment',$batiment)
    ->orderBy('s.level', 'ASC')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }

  public function orderByLevel()
  {
    $qb = $this->createQueryBuilder('s');

    $qb->orderBy('s.level', 'ASC')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }

  public function entityByTownHall($townHall)
  {
    $qb = $this->createQueryBuilder('s');

    $qb->where('s.townHall = :townHall')
    ->setParameter('townHall',$townHall)
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
}
