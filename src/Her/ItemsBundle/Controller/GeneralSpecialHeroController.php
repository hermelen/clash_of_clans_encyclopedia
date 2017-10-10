<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\GeneralSpecialHero;
use Her\ItemsBundle\Form\GeneralSpecialHeroType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Cocur\Slugify\Slugify;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class GeneralSpecialHeroController extends Controller
{
  public function indexAction()
  {
    $singles = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:GeneralSpecialHero')
      ->findAll();

      if (null === $singles) {
        throw new NotFoundHttpException("Aucun bâtiment n'est répertorié.");
      } else {
        return $this->render('HerItemsBundle:GeneralSpecialHero:index.html.twig',array(
          'singles' => $singles
        ));
      }
  }

  /**
   * @ParamConverter("general", options={"mapping": {"general": "slug"}})
   */
  public function singleAction(GeneralSpecialHero $general)
  {
    $singles = $this->getDoctrine()->getManager()->getRepository('HerItemsBundle:SpecialHero')->findBy(array('generalSpecialHero'=>$general));
    $baseTroop = $this->getDoctrine()->getManager()->getRepository('HerItemsBundle:Troop')->entityByLevel($general->getchildTroop(), 1);
      if (null === $general) {
        throw new NotFoundHttpException("Aucun bâtiment n'est répertorié.");
      } else {
        return $this->render('HerItemsBundle:GeneralSpecialHero:single.html.twig',array(
          'general'   => $general,
          'singles'   => $singles,
          'baseTroop' => $baseTroop,
        ));
      }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function addAction(Request $request)
  {
    $slugify = new Slugify();
    $single = new GeneralSpecialHero();

    $em = $this->getDoctrine()->getManager();

    $form   = $this->get('form.factory')->create(GeneralSpecialHeroType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $single->setSlug($slugify->slugify($single->getName()));

      $em->persist($single);
      $em->flush();

      $name = $single->getName();

      $request->getSession()->getFlashBag()->add('notice', $name.' bien enregistré.');

      return $this->redirectToRoute('her_general_special_hero_homepage');
    }

    return $this->render('HerItemsBundle:GeneralSpecialHero:add.html.twig', array(
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

    $single = $em->getRepository('HerItemsBundle:GeneralSpecialHero')->findOneBy(array('slug'=>$slug));

    if (null === $single) {
      throw new NotFoundHttpException($slug." n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(GeneralSpecialHeroType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $single->setSlug($slugify->slugify($single->getName()));
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $single->getName().' bien modifié.');

      return $this->redirectToRoute('her_general_special_hero_single', array('general' => $slug));
    }

    return $this->render('HerItemsBundle:GeneralSpecialHero:edit.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function deleteAction($slug, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $general = $em->getRepository('HerItemsBundle:GeneralSpecialHero')->findOneBy(array(
      'slug'  => $slug,
    ));

    if (null === $general) {
      throw new NotFoundHttpException($slug." n'est pas répertorié");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', $slug."a bien été supprimé.");

      return $this->redirectToRoute('her_general_special_hero_homepage');
    }

    return $this->render('HerItemsBundle:GeneralSpecialHero:delete.html.twig', array(
      'general' => $general,
      'form'   => $form->createView(),
    ));
  }
}
