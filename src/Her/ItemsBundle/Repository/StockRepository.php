<?php

namespace Her\ItemsBundle\Repository;

/**
 * StockRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class StockRepository extends \Doctrine\ORM\EntityRepository
{
  public function orderByLevelFromBatiment($batiment)
  {
    $qb = $this->createQueryBuilder('s');
    $qb->where('s.batiment = :batiment')
       ->setParameter('batiment', $batiment)
       ->orderBy('s.level', 'ASC')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
}