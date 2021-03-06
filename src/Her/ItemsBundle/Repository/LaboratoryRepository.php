<?php

namespace Her\ItemsBundle\Repository;

/**
 * LaboratoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LaboratoryRepository extends \Doctrine\ORM\EntityRepository
{
  public function orderByLevel()
  {
    $qb = $this->createQueryBuilder('a');

    $qb->orderBy('a.level', 'ASC')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }

  public function entityByTownHall($townHall)
  {
    $qb = $this->createQueryBuilder('b');

    $qb->where('b.townHall = :townHall')
    ->setParameter('townHall',$townHall)
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
}
