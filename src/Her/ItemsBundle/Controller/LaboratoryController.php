<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Laboratory;
use Her\ItemsBundle\Entity\TownHallAvailability;
use Her\ItemsBundle\Entity\Batiment;
use Her\ItemsBundle\Form\LaboratoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class LaboratoryController extends Controller
{
  public function indexAction()
  {
    $em = $this
    ->getDoctrine()
    ->getManager();
    $singles = $em->getRepository('HerItemsBundle:Laboratory')->orderByLevel();
    $general = $singles[0]->getBatiment();

    $availabilityRepository = $em->getRepository('HerItemsBundle:TownHallAvailability');
    $townHallAvailabilities = $availabilityRepository->batimentAvailabilityOrderByTownHallLevel($general);

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun Laboratoire n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:Laboratory:index.html.twig',array(
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

    $single = $em->getRepository('HerItemsBundle:Laboratory')->findOneBy(array('level' => $level));

    if (null === $single) {
      throw new NotFoundHttpException("La Caserne niveau .$level. n'est pas encore répertoriée.");
    } else {
      $best = $em->getRepository('HerItemsBundle:Laboratory')->findOneBy(array(
        'level' => $single->getBatiment()->getMaxLevel()
        ));

      $formatDuration = $this->container->get('her_items.services');
      $improvementDuration = $single->getImprovementDuration();

      $formattedDuration = $formatDuration->durationSec($improvementDuration);

      return $this->render('HerItemsBundle:Laboratory:single.html.twig',array(
        'single' => $single,
        'best'   => $best,
        'formattedDuration'=> $formattedDuration,
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("batiment", options={"mapping": {"batiment": "slug"}})
   */
  public function addAction(Request $request, Batiment $batiment)
  {

    $single = new Laboratory();
    $single->setBatiment($batiment);
    $form   = $this->get('form.factory')->create(LaboratoryType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Laboratoire bien enregistré.');

      return $this->redirectToRoute('her_laboratory_single', array('level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:Laboratory:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction($level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $single = $em->getRepository('HerItemsBundle:Laboratory')->findOneBy(array('level'=>$level));

    if (null === $single) {
      throw new NotFoundHttpException("Le Laboratoire ".$level." n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(LaboratoryType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Laboratoire bien modifié.');

      return $this->redirectToRoute('her_laboratory_single', array('level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:Laboratory:edit.html.twig', array(
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

    $single = $em->getRepository('HerItemsBundle:Laboratory')->findOneBy(array('level'=>$level));

    if (null === $single) {
      throw new NotFoundHttpException("Le Laboratoire niveau ".$level." n'est pas répertorié");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "Le Laboratoire a bien été supprimé.");

      return $this->redirectToRoute('her_laboratory_homepage');
    }

    return $this->render('HerItemsBundle:Laboratory:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
