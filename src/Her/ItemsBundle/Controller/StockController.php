<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Stock;
use Her\ItemsBundle\Entity\Batiment;
use Her\ItemsBundle\Entity\TownHallAvailability;
use Her\ItemsBundle\Form\StockType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class StockController extends Controller
{
  /**
   * @ParamConverter("general", options={"mapping": {"slug": "slug"}})
   */
  public function indexAction(Batiment $general)
  {
    $em = $this
    ->getDoctrine()
    ->getManager();
    $availabilityRepository = $em->getRepository('HerItemsBundle:TownHallAvailability');
    $townHallAvailabilities = $availabilityRepository->batimentAvailabilityOrderByTownHallLevel($general);
    $singles = $em->getRepository('HerItemsBundle:Stock')->orderByLevelFromBatiment($general);

    if (null === $general) {
      throw new NotFoundHttpException("Aucun '.$general->getName().' n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:Stock:index.html.twig',array(
        'singles'               => $singles,
        'general'              => $general,
        'townHallAvailabilities'=> $townHallAvailabilities,
      ));
    }
  }

  /**
   * @ParamConverter("general", options={"mapping": {"slug": "slug"}})
   * @ParamConverter("level", options={"mapping": {"level": "level"}})
   */
  public function singleAction(Batiment $general, Stock $level)
  {
    $repo = $this
    ->getDoctrine()
    ->getManager()
    ->getRepository('HerItemsBundle:Stock');
    $single = $repo->findOneBy(array(
      'level'   => $level->getLevel(),
      'batiment'=> $general
      ));

    if (null === $single) {
      throw new NotFoundHttpException("Niveau pas encore créé pour ".$general->getName());
    } else {

      $best = $repo->findOneBy(array(
        'level'   => $general->getMaxLevel(),
        'batiment'=> $general
        ));

      $formatDuration = $this->container->get('her_items.services');
      $improvementDuration = $single->getImprovementDuration();

      $formattedImprovementDuration = $formatDuration->durationSec($improvementDuration);

      return $this->render('HerItemsBundle:Stock:single.html.twig',array(
        'general'                    => $general,
        'single'                        => $single,
        'best'                    => $best,
        'formattedImprovementDuration'=> $formattedImprovementDuration,
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("general", options={"mapping": {"slug": "slug"}})
   */
  public function addAction(Request $request, Batiment $general)
  {
    $em = $this->getDoctrine()->getManager();

    $single = new Stock();
    $single->setBatiment($general);
    $form = $this->get('form.factory')->create(StockType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->persist($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $general->getName().' bien enregistré.');

      return $this->redirectToRoute('her_stock_single', array(
        'slug' => $general->getSlug(),
        'level'    => $single->getLevel()
      ));
    }

    return $this->render('HerItemsBundle:Stock:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("general", options={"mapping": {"slug": "slug"}})
   * @ParamConverter("level", options={"mapping": {"level": "level"}})
   */
  public function editAction(Batiment $general, Stock $level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $single = $em->getRepository('HerItemsBundle:Stock')->findOneBy(array(
      'level'   => $level->getLevel(),
      'batiment'=> $general
      ));

    if (null === $single) {
      throw new NotFoundHttpException("Niveau pas encore créé pour ".$general->getName());
    }

    $form = $this->get('form.factory')->create(StockType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $general->getName().' niveau '.$single->getLevel().' bien modifié.');

      return $this->redirectToRoute('her_stock_single', array(
        'slug' => $general->getSlug(),
        'level'    => $single->getLevel()
      ));
    }

    return $this->render('HerItemsBundle:Stock:edit.html.twig', array(
      'single'     => $single,
      'form'     => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("general", options={"mapping": {"slug": "slug"}})
   * @ParamConverter("level", options={"mapping": {"level": "level"}})
   */
  public function deleteAction(Batiment $general, Stock $level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $single = $em->getRepository('HerItemsBundle:Stock')->findOneBy(array(
      'level'   => $level->getLevel(),
      'batiment'=> $general
      ));

    if (null === $single) {
      throw new NotFoundHttpException("Niveau pas encore créé pour ".$general->getName());
    }

    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $general->getName().' niveau '.$single->getLevel().' supprimé.');

      return $this->redirectToRoute('her_stock_homepage', array(
        'slug' => $general->getSlug(),
      ));
    }

    return $this->render('HerItemsBundle:Stock:delete.html.twig', array(
      'single'     => $single,
      'form'     => $form->createView(),
    ));
  }
}
