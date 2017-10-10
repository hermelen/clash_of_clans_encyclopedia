<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\SpecialHero;
use Her\ItemsBundle\Entity\TownHallAvailability;
use Her\ItemsBundle\Entity\GeneralSpecialHero;
use Her\ItemsBundle\Form\SpecialHeroType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class SpecialHeroController extends Controller
{
  // public function indexAction()
  // {
  //   $em = $this
  //   ->getDoctrine()
  //   ->getManager();
  //   $singles = $em->getRepository('HerItemsBundle:Laboratory')->orderByLevel();
  //   $general = $singles[0]->getBatiment();
  //
  //   $availabilityRepository = $em->getRepository('HerItemsBundle:TownHallAvailability');
  //   $townHallAvailabilities = $availabilityRepository->batimentAvailabilityOrderByTownHallLevel($general);
  //
  //   if (null === $singles) {
  //     throw new NotFoundHttpException("Aucun Laboratoire n'est répertorié.");
  //   } else {
  //     return $this->render('HerItemsBundle:Laboratory:index.html.twig',array(
  //       'singles' => $singles,
  //       'general' => $general,
  //       'townHallAvailabilities'=> $townHallAvailabilities,
  //     ));
  //   }
  // }

  /**
   * @ParamConverter("general", options={"mapping": {"general": "slug"}})
   */
  public function singleAction(GeneralSpecialHero $general, $level)
  {
    $em = $this
    ->getDoctrine()
    ->getManager();

    $single = $em->getRepository('HerItemsBundle:SpecialHero')->findOneBy(array('generalSpecialHero' => $general, 'level' => $level));
    $childs = $em->getRepository('HerItemsBundle:Troop')->entityOrderByLevel($general->getChildTroop());
    $heros = $em->getRepository('HerItemsBundle:Troop')->herosOrderByLevel($single);
    if (null === $single) {
      throw new NotFoundHttpException("La ".$general->getName()." ".$level." n'est pas encore répertoriée.");
    } else {
      $best = $em->getRepository('HerItemsBundle:SpecialHero')->findOneBy(array(
        'level' => $general->getMaxLevel()
        ));

      $formatDuration = $this->container->get('her_items.services');
      $specialDuration = $formatDuration->durationSec($single->getSpecialDuration());

      return $this->render('HerItemsBundle:SpecialHero:single.html.twig',array(
        'general'         => $general,
        'single'          => $single,
        'best'            => $best,
        'specialDuration' => $specialDuration,
        'childs'          => $childs,
        'heros'           => $heros,
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("general", options={"mapping": {"general": "slug"}})
   */
  public function addAction(Request $request, GeneralSpecialHero $general)
  {

    $single = new SpecialHero();
    $single->setGeneralSpecialHero($general);
    $form   = $this->get('form.factory')->create(SpecialHeroType::class, $single, ['general'=>$general]);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $general->getName()." niveau ".$single->getLevel()." enregistré.");
      return $this->redirectToRoute('her_special_hero_single', array('general' => $general->getSlug(), 'level' => $single->getLevel()));
    }

    return $this->render('HerItemsBundle:SpecialHero:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("general", options={"mapping": {"general": "slug"}})
   * @ParamConverter("level", options={"mapping": {"level": "level"}})
   */
  public function editAction(Request $request, GeneralSpecialHero $general, SpecialHero $level)
  {
    $em = $this->getDoctrine()->getManager();

    if (null === $level) {
      throw new NotFoundHttpException("Ce niveau de ".$general->getName()."n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(SpecialHeroType::class, $level, ['general'=>$general]);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      // $form->submit($request, true);// second arg true is the trick
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $level->getGeneralSpecialHero()->getName()." niveau ".$level->getLevel()." bien modifié.");

      return $this->redirectToRoute('her_special_hero_single', array('general' => $general->getSlug(), 'level' => $level->getLevel()));
    }

    return $this->render('HerItemsBundle:SpecialHero:edit.html.twig', array(
      'single' => $level,
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
