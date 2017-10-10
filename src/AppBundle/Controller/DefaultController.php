<?php

namespace AppBundle\Controller;

use Her\ItemsBundle\Entity\Troop;
use Her\ItemsBundle\Entity\GeneralTroop;
use Her\ItemsBundle\Form\GeneralTroopType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
  public function indexAction()
  {
    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Troop');
    $troops = $singleRepository->findBy(array(
      'level'=> 1
    ));

    if (null === $troops) {
      throw new NotFoundHttpException("Aucun combattant n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:Default:index.html.twig',array(
        'troops' => $troops
      ));
    }
  }
}
