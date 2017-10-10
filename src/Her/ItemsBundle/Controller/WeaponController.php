<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Weapon;
use Her\ItemsBundle\Entity\GeneralWeapon;
use Her\ItemsBundle\Form\WeaponType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class WeaponController extends Controller
{
  public function singleAction($slug, $level)
  {
    $generalRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:GeneralWeapon');

    $general = $generalRepository->findOneBy(array(
      'slug' => $slug));

    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Weapon');
    $single = $singleRepository->entityByLevel($general, $level);



    if (null === $single) {
      throw new NotFoundHttpException(".$slug. niveau .$level. n'est pas encore répertorié.");
    } else {
      $bestWeapon = $singleRepository->entityByLevel($general, $general->getMaxLevel());

      $formatDuration = $this->container->get('her_items.services');
      $formattedDuration = $formatDuration->durationSec($single->getImprovementDuration());

      return $this->render('HerItemsBundle:Weapon:single.html.twig',array(
        'single'       => $single,
        'bestWeapon'         => $bestWeapon,
        'formattedDuration' => $formattedDuration,
        'general'      => $general,
      ));
    }

  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   * @ParamConverter("slug", options={"mapping": {"slug": "slug"}})
   */
  public function addAction(Request $request, GeneralWeapon $slug)
  {
    $single = new Weapon();
    $single->setGeneralWeapon($slug);
    $form   = $this->get('form.factory')->create(WeaponType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($single);
      $em->flush();

      $level = $single->getLevel();

      $request->getSession()->getFlashBag()->add('notice', $single->getName().' niveau '.$level.' bien enregistré.');

      return $this->redirectToRoute('her_weapon_single', array(
        'slug' => $slug,
        'level' => $level,
      ));
    }

    return $this->render('HerItemsBundle:Weapon:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction($slug, $level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $general = $em->getRepository('HerItemsBundle:GeneralWeapon')->findOneBy(array(
      'slug' => $slug));

    $single = $em->getRepository('HerItemsBundle:Weapon')->entityByLevel($general, $level);

    if (null === $single) {
      throw new NotFoundHttpException($slug."niveau".$level."n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(WeaponType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $single->getGeneralWeapon()->getName().' niveau '.$single->getLevel().' bien modifié.');

      return $this->redirectToRoute('her_weapon_single', array(
        'slug' =>  $single->getGeneralWeapon()->getSlug(),
        'level' => $single->getLevel()
      ));
    }

    return $this->render('HerItemsBundle:Weapon:edit.html.twig', array(
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

    $general = $em->getRepository('HerItemsBundle:GeneralWeapon')->findOneBy(array(
      'slug' => $slug));

    $single = $em->getRepository('HerItemsBundle:Weapon')->entityByLevel($general, $level);

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

      return $this->redirectToRoute('her_general_weapon_single', array(
        'slug' => $slug,
      ));
    }

    return $this->render('HerItemsBundle:Weapon:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
