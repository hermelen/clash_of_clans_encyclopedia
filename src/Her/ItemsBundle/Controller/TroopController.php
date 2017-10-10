<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Troop;
use Her\ItemsBundle\Entity\GeneralTroop;
use Her\ItemsBundle\Form\TroopType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TroopController extends Controller
{
  public function singleAction($slug, $level)
  {
    $generalRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:GeneralTroop');

    $general = $generalRepository->findOneBy(array(
      'slug' => $slug));

    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Troop');
    $single = $singleRepository->entityByLevel($general, $level);



    if (null === $single) {
      throw new NotFoundHttpException(".$slug. niveau .$level. n'est pas encore répertorié.");
    } else {
      $best = $singleRepository->entityByLevel($general, $general->getMaxLevel());

      $formatDuration = $this->container->get('her_items.services');
      $improvementDuration = $formatDuration->durationSec($single->getImprovementDuration());
      $healingDuration = $formatDuration->durationSec($single->getHealingDuration());

      return $this->render('HerItemsBundle:Troop:single.html.twig',array(
        'single'              => $single,
        'best'                => $best,
        'improvementDuration' => $improvementDuration,
        'healingDuration'     => $healingDuration,
        'general'             => $general,
      ));
    }

  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("slug", options={"mapping": {"slug": "slug"}})
   */
  public function addAction(Request $request, GeneralTroop $slug)
  {
    $single = new Troop();
    $single->setGeneralTroop($slug);
    $form   = $this->get('form.factory')->create(TroopType::class, $single, array('general'=>$slug));

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($single);
      $em->flush();

      $level = $single->getLevel();
      $name = $slug->getName();

      $request->getSession()->getFlashBag()->add('notice', $name.' niveau '.$level.' bien enregistré.');

      return $this->redirectToRoute('her_troop_single', array(
        'slug' => $slug->getSlug(),
        'level' => $level,
      ));
    }

    return $this->render('HerItemsBundle:Troop:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction($slug, $level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $general = $em->getRepository('HerItemsBundle:GeneralTroop')->findOneBy(array(
      'slug' => $slug));

    $single = $em->getRepository('HerItemsBundle:Troop')->entityByLevel($general, $level);
    $troopType = $general->getTroopType();
    if (null === $single) {
      throw new NotFoundHttpException($slug."niveau".$level."n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(TroopType::class, $single,  array('general'=>$general));

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $single->getGeneralTroop()->getName().' niveau '.$single->getLevel().' bien modifié.');

      return $this->redirectToRoute('her_troop_single', array(
        'slug' =>  $single->getGeneralTroop()->getSlug(),
        'level' => $single->getLevel()
      ));
    }

    return $this->render('HerItemsBundle:Troop:edit.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function deleteAction($slug, $level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $general = $em->getRepository('HerItemsBundle:GeneralTroop')->findOneBy(array(
      'slug' => $slug));

    $single = $em->getRepository('HerItemsBundle:Troop')->entityByLevel($general, $level);

    if (null === $single) {
      throw new NotFoundHttpException(".$slug. niveau ".$level." n'est pas répertorié");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', ".$slug. niveau ".$level." a bien été supprimé.");

      return $this->redirectToRoute('her_general_troop_single', array(
        'slug' => $slug,
      ));
    }

    return $this->render('HerItemsBundle:Troop:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
