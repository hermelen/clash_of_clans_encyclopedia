<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Troop;
use Her\ItemsBundle\Entity\GeneralTroop;
use Her\ItemsBundle\Form\GeneralTroopType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Cocur\Slugify\Slugify;

class GeneralTroopController extends Controller
{
  public function indexAction()
  {
    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Troop');
    $singles = $singleRepository->findBy(array(
      'level'=> 1
    ));

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun combattant n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:GeneralTroop:index.html.twig',array(
        'singles' => $singles
      ));
    }
  }

  public function singleAction($slug)
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

    $singles = $singleRepository->entityOrderByLevel($general);

    $base = $singleRepository->findOneBy(array(
      'generalTroop' => $general,
      'level'        => 1,
    ));

    if (null === $general) {
      throw new NotFoundHttpException("Le combattant ".$slug." n'est pas encore répertorié.");
    } else {

      $formatDuration = $this->container->get('her_items.services');
      $trainingDuration = $general->getTrainingDuration();

      $trainingDuration_4 = $formatDuration->durationSec($trainingDuration);
      $trainingDuration_3 = $formatDuration->durationSec($trainingDuration * 4/3);
      $trainingDuration_2 = $formatDuration->durationSec($trainingDuration * 2);
      $trainingDuration_1 = $formatDuration->durationSec($trainingDuration * 4);


      return $this->render('HerItemsBundle:GeneralTroop:single.html.twig',array(
        'singles'       => $singles,
        'general'       => $general,
        'base'          => $base,
        'trainingDuration_4' => $trainingDuration_4,
        'trainingDuration_3' => $trainingDuration_3,
        'trainingDuration_2' => $trainingDuration_2,
        'trainingDuration_1' => $trainingDuration_1,
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function addAction(Request $request)
  {
    $slugify = new Slugify();
    $general = new GeneralTroop();

    $em = $this->getDoctrine()->getManager();
    $form   = $this->get('form.factory')->create(GeneralTroopType::class, $general);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $general->setSlug($slugify->slugify($general->getName()));

      $em->persist($general);
      $em->flush();

      $name = $general->getName();
      $slug = $general->getSlug();

      $request->getSession()->getFlashBag()->add('notice', $name.' bien enregistré.');

      return $this->redirectToRoute('her_general_troop_single', array(
        'slug' => $slug,
      ));
    }

    return $this->render('HerItemsBundle:GeneralTroop:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction($slug, Request $request)
  {
    $slugify = new Slugify();
    $em = $this->getDoctrine()->getManager();

    $general = $em->getRepository('HerItemsBundle:GeneralTroop')->findOneBy(array('slug'=>$slug));

    if (null === $general) {
      throw new NotFoundHttpException($slug." n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(GeneralTroopType::class, $general);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $general->setSlug($slugify->slugify($general->getName()));
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $general->getName().' bien modifié.');

      return $this->redirectToRoute('her_general_troop_single', array(
        'slug' => $general->getSlug(),
      ));
    }

    return $this->render('HerItemsBundle:GeneralTroop:edit.html.twig', array(
      'general' => $general,
      'form'   => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function deleteAction($slug, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $general = $em->getRepository('HerItemsBundle:GeneralTroop')->findOneBy(array(
      'slug'  => $slug,
    ));

    if (null === $general) {
      throw new NotFoundHttpException($slug."n'est pas répertorié");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($general);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', $slug."a bien été supprimé.");

      return $this->redirectToRoute('her_general_troop_single', array(
        'slug' => $slug,
      ));
    }

    return $this->render('HerItemsBundle:GeneralTroop:delete.html.twig', array(
      'general' => $general,
      'form'   => $form->createView(),
    ));
  }
}
