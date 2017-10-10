<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Barrack;
use Her\ItemsBundle\Entity\TownHallAvailability;
use Her\ItemsBundle\Entity\Batiment;
use Her\ItemsBundle\Form\BarrackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class BarrackController extends Controller
{
  public function indexAction()
  {
    $em = $this
    ->getDoctrine()
    ->getManager();
    $singles = $em->getRepository('HerItemsBundle:Barrack')->orderByLevel();
    $general = $singles[0]->getBatiment();
    $availabilityRepository = $em->getRepository('HerItemsBundle:TownHallAvailability');
    $townHallAvailabilities = $availabilityRepository->batimentAvailabilityOrderByTownHallLevel($general);

    if (null === $singles) {
      throw new NotFoundHttpException("Aucune Caserne n'est répertoriée.");
    } else {
      return $this->render('HerItemsBundle:Barrack:index.html.twig',array(
        'singles' => $singles,
        'general' => $general,
        'townHallAvailabilities'=> $townHallAvailabilities,
      ));
    }
  }

  public function singleAction($level)
  {
    $em = $this
    ->getDoctrine()
    ->getManager();

    $single = $em->getRepository('HerItemsBundle:Barrack')->findOneBy(array('level' => $level));
    $general = $em->getRepository('HerItemsBundle:Batiment')->findOneBy(array(
      'name' => $single->getBatiment()->getName()
    ));
    $baseTroop = $em->getRepository('HerItemsBundle:Troop')->entityByLevel($single->getGeneralTroop(), 1);

    if (null === $single) {
      throw new NotFoundHttpException("La Caserne niveau .$level. n'est pas encore répertoriée.");
    } else {
      $bestBarrack = $em->getRepository('HerItemsBundle:Barrack')->findOneBy(array('level' => $general->getMaxLevel() ) );

      $formatDuration = $this->container->get('her_items.services');
      $improvementDuration = $single->getImprovementDuration();

      $formattedDuration = $formatDuration->durationSec($improvementDuration);

      return $this->render('HerItemsBundle:Barrack:single.html.twig',array(
        'general'  => $general,
        'single'    => $single,
        'bestBarrack'      => $bestBarrack,
        'formattedDuration'=> $formattedDuration,
        'baseTroop'        => $baseTroop,
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("batiment", options={"mapping": {"batiment": "slug"}})
   */
  public function addAction(Request $request, Batiment $batiment)
  {
    $em = $this->getDoctrine()->getManager();

    $single = new Barrack();
    $single->setBatiment($batiment);
    $form   = $this->get('form.factory')->create(BarrackType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->persist($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Caserne bien enregistrée.');

      return $this->redirectToRoute('her_barrack_single', array('level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:Barrack:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction($level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $single = $em->getRepository('HerItemsBundle:Barrack')->findOneBy(array('level'=>$level));

    if (null === $single) {
      throw new NotFoundHttpException("La Caserne ".$level." n'est pas répertoriée");
    }

    $form = $this->get('form.factory')->create(BarrackType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Caserne bien modifiée.');

      return $this->redirectToRoute('her_barrack_single', array('level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:Barrack:edit.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function deleteAction($level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $single = $em->getRepository('HerItemsBundle:Barrack')->findOneBy(array('level'=>$level));

    if (null === $single) {
      throw new NotFoundHttpException("La Caserne niveau ".$level." n'est pas répertoriée");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "La Caserne a bien été supprimée.");

      return $this->redirectToRoute('her_barrack_homepage');
    }

    return $this->render('HerItemsBundle:Barrack:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
