<?php

namespace Her\ItemsBundle\Repository;

/**
 * SpellRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SpellRepository extends \Doctrine\ORM\EntityRepository
{
  public function entityOrderByLevel($generalEntity)
  {
    $qb = $this->createQueryBuilder('s');

    $qb->orderBy('s.level', 'ASC')
    ->andWhere('s.generalSpell = :generalSpell')
    ->setParameter('generalSpell',$generalEntity);
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }

  public function entityByLevel($generalSpell, $level)
  {
    $qb = $this->createQueryBuilder('t');

    $qb->where('t.generalSpell = :generalSpell')
    ->setParameter('generalSpell',$generalSpell)
    ->andWhere('t.level = :level')
    ->setParameter('level', $level)
    ;

    return $qb
      ->getQuery()
      ->getOneOrNullResult()
    ;
  }  
}