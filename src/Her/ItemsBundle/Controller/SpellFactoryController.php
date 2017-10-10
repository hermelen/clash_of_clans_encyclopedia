<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\SpellFactory;
use Her\ItemsBundle\Entity\TownHallAvailability;
use Her\ItemsBundle\Entity\Batiment;
use Her\ItemsBundle\Form\SpellFactoryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SpellFactoryController extends Controller
{
  public function indexAction()
  {
    $em = $this
    ->getDoctrine()
    ->getManager();
    $general = $em->getRepository('HerItemsBundle:Batiment')->findOneBy(array(
      'id' => 6
    ));
    $availabilityRepository = $em->getRepository('HerItemsBundle:TownHallAvailability');
    $townHallAvailabilities = $availabilityRepository->batimentAvailabilityOrderByTownHallLevel($general);

    $singles = $em->getRepository('HerItemsBundle:SpellFactory')->orderByTypeAndLevel($general);

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun Usine de Sorts n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:SpellFactory:index.html.twig',array(
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

    $general = $em->getRepository('HerItemsBundle:Batiment')->findOneBy(array(
      'id' => 6
    ));

    $single = $em->getRepository('HerItemsBundle:SpellFactory')->findOneBy(array(
      'level' => $level,
      'batiment' => $general));

    $generalSpell = $em->getRepository('HerItemsBundle:GeneralSpell')->findOneBy(array(
      'spellFactory' => $single
    ));

    if (null === $single) {
      throw new NotFoundHttpException("La Caserne niveau .$level. n'est pas encore répertoriée.");
    } else {
      $best = $em->getRepository('HerItemsBundle:SpellFactory')->findOneBy(array(
        'level'   => $general->getMaxLevel(),
        'batiment'=> $general,
        ));

      $formatDuration = $this->container->get('her_items.services');
      $improvementDuration = $single->getImprovementDuration();

      $formattedDuration = $formatDuration->durationSec($improvementDuration);

      return $this->render('HerItemsBundle:SpellFactory:single.html.twig',array(
        'single' => $single,
        'best'   => $best,
        'formattedDuration'  => $formattedDuration,
        'generalSpell'       => $generalSpell,
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

    $single = new SpellFactory();
    $single->setBatiment($batiment);
    $form   = $this->get('form.factory')->create(SpellFactoryType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->persist($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Usine de Sorts bien enregistré.');

      return $this->redirectToRoute('her_spell_factory_single', array('level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:SpellFactory:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction($level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $batiment = $em->getRepository('HerItemsBundle:Batiment')->findOneBy(array( 'id' => 6 ));
    $single = $em->getRepository('HerItemsBundle:SpellFactory')->findOneBy(array(
      'batiment'=>$batiment,
      'level'=>$level
    ));

    if (null === $single) {
      throw new NotFoundHttpException("Le Usine de Sorts ".$level." n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(SpellFactoryType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Usine de Sorts bien modifié.');

      return $this->redirectToRoute('her_spell_factory_single', array('level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:SpellFactory:edit.html.twig', array(
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
    $batiment = $em->getRepository('HerItemsBundle:Batiment')->findOneBy(array( 'id' => 6 ));
    $single = $em->getRepository('HerItemsBundle:SpellFactory')->findOneBy(array(
      'batiment'=>$batiment,
      'level'=>$level
    ));

    if (null === $single) {
      throw new NotFoundHttpException("Le Usine de Sorts niveau ".$level." n'est pas répertorié");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', "Le Usine de Sorts a bien été supprimé.");

      return $this->redirectToRoute('her_spell_factory_homepage');
    }

    return $this->render('HerItemsBundle:SpellFactory:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
