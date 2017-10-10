<?php

namespace Her\CountBundle\Counter;

// use Symfony\Bundle\FrameworkBundle\Controller\Controller;
// use Symfony\Component\HttpFoundation\Request;
// use Her\CountBundle\Entity\Visitor;

use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManager;


class VisitorCounter
{
  protected $em;

  public function __construct(EntityManager $entityManager)
  {
    $this->em = $entityManager;
  }

  public function addVisitor(Response $response, $visitor)
  {
    if($visitor->getIp() !== "::1"){
      $this->em->persist($visitor);
      $this->em->flush();      
    }
  }
}
