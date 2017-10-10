<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\GeneralWeapon;
use Her\ItemsBundle\Entity\TownHallAvailability;
use Her\ItemsBundle\Form\GeneralWeaponType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Cocur\Slugify\Slugify;

class GeneralWeaponController extends Controller
{
  public function indexAction()
  {
    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Weapon');
    $singles = $singleRepository->findBy(array(
      'level'=> 1
    ));

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun combattant n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:GeneralWeapon:index.html.twig',array(
        'singles' => $singles
      ));
    }
  }

  public function indexWeaponAction()
  {
    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Weapon');
    $singles = $singleRepository->findBy(array(
      'level'=> 1,
      'defense' => 2,
    ));

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun combattant n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:GeneralWeapon:index.html.twig',array(
        'singles' => $singles
      ));
    }
  }

  public function indexTrapAction()
  {
    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Weapon');
    $singles = $singleRepository->findBy(array(
      'level'=> 1,
      'defense' => 1,
    ));

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun combattant n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:GeneralWeapon:index.html.twig',array(
        'singles' => $singles
      ));
    }
  }

  public function indexRampartAction()
  {
    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Weapon');
    $singles = $singleRepository->findBy(array(
      'level'=> 1,
      'defense' => 3,
    ));

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun combattant n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:GeneralWeapon:index.html.twig',array(
        'singles' => $singles
      ));
    }
  }

  public function singleAction($slug)
  {
    $em = $this
      ->getDoctrine()
      ->getManager();

    $generalRepository = $em->getRepository('HerItemsBundle:GeneralWeapon');
    $general = $generalRepository->findOneBy(array(
      'slug' => $slug));

    $availabilityRepository = $em->getRepository('HerItemsBundle:TownHallAvailability');
    $townHallAvailabilities = $availabilityRepository->weaponAvailabilityOrderByTownHallLevel($general);

    $singleRepository = $em->getRepository('HerItemsBundle:Weapon');
    $singles = $singleRepository->entityOrderByLevel($general);

    $baseWeapon = $singleRepository->findOneBy(array(
      'generalWeapon' => $general,
      'level'        => 1,
    ));

    if (null === $general) {
      throw new NotFoundHttpException("La défense ".$slug." n'est pas encore répertoriée.");
    } else {
      return $this->render('HerItemsBundle:GeneralWeapon:single.html.twig',array(
        'singles'         => $singles,
        'general'         => $general,
        'baseWeapon'            => $baseWeapon,
        'townHallAvailabilities'=> $townHallAvailabilities
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function addAction(Request $request)
  {
    $slugify = new Slugify();
    $em = $this->getDoctrine()->getManager();
    $townHalls = $em->getRepository('HerItemsBundle:TownHall')->orderByLevel();

    $general = new GeneralWeapon();

    foreach ($townHalls as $townHall){
      $townHallAvailability = new TownHallAvailability();
      $townHallAvailability->setTownHall($townHall);
      $general->addTownHallAvailability($townHallAvailability);
    }

    $form   = $this->get('form.factory')->create(GeneralWeaponType::class, $general);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $general->setSlug($slugify->slugify($general->getName()));
      $em->persist($general);
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', 'Arme bien enregistrée.');

      return $this->redirectToRoute('her_general_weapon_single', array('slug' => $general->getSlug()));
    }

    return $this->render('HerItemsBundle:GeneralWeapon:add.html.twig', array(
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

    $general = $em->getRepository('HerItemsBundle:GeneralWeapon')->findOneBy(array('slug'=>$slug));

    if (null === $general) {
      throw new NotFoundHttpException($slug." n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(GeneralWeaponType::class, $general);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $general->setSlug($slugify->slugify($general->getName()));
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $general->getName().' bien modifié.');

      return $this->redirectToRoute('her_general_weapon_single', array(
        'slug' => $general->getSlug(),
      ));
    }

    return $this->render('HerItemsBundle:GeneralWeapon:edit.html.twig', array(
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

    $general = $em->getRepository('HerItemsBundle:GeneralWeapon')->findOneBy(array(
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

      return $this->redirectToRoute('her_general_weapon_homepage');
    }

    return $this->render('HerItemsBundle:GeneralWeapon:delete.html.twig', array(
      'general' => $general,
      'form'   => $form->createView(),
    ));
  }


}
