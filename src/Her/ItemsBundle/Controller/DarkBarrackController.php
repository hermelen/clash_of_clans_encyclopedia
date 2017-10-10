<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\DarkBarrack;
use Her\ItemsBundle\Entity\TownHallAvailability;
use Her\ItemsBundle\Entity\Batiment;
use Her\ItemsBundle\Form\DarkBarrackType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class DarkBarrackController extends Controller
{
  public function indexAction()
  {
    $em = $this
    ->getDoctrine()
    ->getManager();
    $singles = $em->getRepository('HerItemsBundle:DarkBarrack')->orderByLevel();
    $general = $singles[0]->getBatiment();
    $availabilityRepository = $em->getRepository('HerItemsBundle:TownHallAvailability');
    $townHallAvailabilities = $availabilityRepository->batimentAvailabilityOrderByTownHallLevel($general);

    if (null === $singles) {
      throw new NotFoundHttpException("Aucune Caserne Noire n'est répertoriée.");
    } else {
      return $this->render('HerItemsBundle:DarkBarrack:index.html.twig',array(
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

    $single = $em->getRepository('HerItemsBundle:DarkBarrack')->findOneBy(array('level' => $level));
    $general = $em->getRepository('HerItemsBundle:Batiment')->findOneBy(array(
      'name' => 'Caserne Noire'
    ));
    $base = $em->getRepository('HerItemsBundle:Troop')->entityByLevel($single->getGeneralTroop(), 1);

    if (null === $single) {
      throw new NotFoundHttpException("La Caserne Noire niveau .$level. n'est pas encore répertoriée.");
    } else {
      $best = $em->getRepository('HerItemsBundle:DarkBarrack')->findOneBy(array('level' => $general->getMaxLevel() ) );

      $formatDuration = $this->container->get('her_items.services');
      $improvementDuration = $single->getImprovementDuration();

      $formattedDuration = $formatDuration->durationSec($improvementDuration);

      return $this->render('HerItemsBundle:DarkBarrack:single.html.twig',array(
        'level'            => $level,
        'general'  => $general,
        'single'    => $single,
        'best'      => $best,
        'formattedDuration'=> $formattedDuration,
        'base'        => $base,
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

    $single = new DarkBarrack();
    $single->setBatiment($batiment);
    $form   = $this->get('form.factory')->create(DarkBarrackType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->persist($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Caserne Noire bien enregistrée.');

      return $this->redirectToRoute('her_dark_barrack_single', array('level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:DarkBarrack:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction($level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $single = $em->getRepository('HerItemsBundle:DarkBarrack')->findOneBy(array('level'=>$level));

    if (null === $single) {
      throw new NotFoundHttpException("La Caserne Noire ".$level." n'est pas répertoriée");
    }

    $form = $this->get('form.factory')->create(DarkBarrackType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Caserne Noire bien modifiée.');

      return $this->redirectToRoute('her_dark_barrack_single', array('level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:DarkBarrack:edit.html.twig', array(
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

    $single = $em->getRepository('HerItemsBundle:DarkBarrack')->findOneBy(array('level'=>$level));

    if (null === $single) {
      throw new NotFoundHttpException("La Caserne Noire niveau ".$level." n'est pas répertoriée");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "La Caserne Noire a bien été supprimée.");

      return $this->redirectToRoute('her_dark_barrack_homepage');
    }

    return $this->render('HerItemsBundle:DarkBarrack:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
