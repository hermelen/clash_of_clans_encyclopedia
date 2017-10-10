<?php

namespace Her\ItemsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class DefaultController extends Controller
{
  public function indexAction()
  {
      return $this->render('HerItemsBundle:Default:index.html.twig');
  }
}
