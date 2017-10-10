<?php

namespace Her\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('HerUserBundle:Default:index.html.twig');
    }
}
