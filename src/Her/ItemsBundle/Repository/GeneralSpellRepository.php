<?php

namespace Her\ItemsBundle\Repository;

/**
 * GeneralSpellRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GeneralSpellRepository extends \Doctrine\ORM\EntityRepository
{
  public function entityBySpellFactory($spellFactory)
  {
    $qb = $this->createQueryBuilder('t');

    $qb->where('t.spellFactory = :spellFactory')
    ->setParameter('spellFactory',$spellFactory)
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
  public function orderedEntityFactory($resource)
  {
    $qb = $this->createQueryBuilder('s');

    $qb
    ->where('s.resource = :resource')
    ->setParameter('resource', $resource)
    ->orderBy('s.name', 'ASC')
    ;

    return $qb
      ->getQuery()
      ->getResult()
    ;
  }
}