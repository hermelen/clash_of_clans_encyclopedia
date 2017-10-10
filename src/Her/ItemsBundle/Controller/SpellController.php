<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Spell;
use Her\ItemsBundle\Entity\GeneralSpell;
use Her\ItemsBundle\Form\SpellType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class SpellController extends Controller
{
  public function singleAction($slug, $level)
  {
    $generalRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:GeneralSpell');

    $general = $generalRepository->findOneBy(array(
      'slug' => $slug));

    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Spell');
    $single = $singleRepository->entityByLevel($general, $level);



    if (null === $single) {
      throw new NotFoundHttpException(".$slug. niveau .$level. n'est pas encore répertorié.");
    } else {
      $best = $singleRepository->entityByLevel($general, $general->getMaxLevel());

      $formatDuration = $this->container->get('her_items.services');
      $formattedDuration = $formatDuration->durationSec($single->getImprovementDuration());

      return $this->render('HerItemsBundle:Spell:single.html.twig',array(
        'single'       => $single,
        'best'         => $best,
        'formattedDuration' => $formattedDuration,
        'general'      => $general,
      ));
    }

  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function addAction($slug, Request $request)
  {
    $generalRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:GeneralSpell');

    $general = $generalRepository->findOneBy(array(
      'slug' => $slug));

    $single = new Spell();
    $single->setGeneralSpell($general);
    $form   = $this->get('form.factory')->create(SpellType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em = $this->getDoctrine()->getManager();
      $em->persist($single);
      $em->flush();

      $level = $single->getLevel();
      $name = $single->getName();

      $request->getSession()->getFlashBag()->add('notice', $name.' niveau '.$level.' bien enregistré.');

      return $this->redirectToRoute('her_spell_single', array(
        'slug' => $slug,
        'level' => $level,
      ));
    }

    return $this->render('HerItemsBundle:Spell:add.html.twig', array(
      'form' => $form->createView(),
    ));
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function editAction($slug, $level, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $general = $em->getRepository('HerItemsBundle:GeneralSpell')->findOneBy(array(
      'slug' => $slug));

    $single = $em->getRepository('HerItemsBundle:Spell')->entityByLevel($general, $level);

    if (null === $single) {
      throw new NotFoundHttpException($slug."niveau".$level."n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(SpellType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      // Inutile de persister ici, Doctrine connait déjà notre annonce
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $single->getGeneralSpell()->getName().' niveau '.$single->getLevel().' bien modifié.');

      return $this->redirectToRoute('her_spell_single', array(
        'slug' =>  $single->getGeneralSpell()->getSlug(),
        'level' => $single->getLevel()
      ));
    }

    return $this->render('HerItemsBundle:Spell:edit.html.twig', array(
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

    $general = $em->getRepository('HerItemsBundle:GeneralSpell')->findOneBy(array(
      'slug' => $slug));

    $single = $em->getRepository('HerItemsBundle:Spell')->entityByLevel($general, $level);

    if (null === $single) {
      throw new NotFoundHttpException(".$slug. niveau ".$level." n'est pas répertorié");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', ".$name. niveau ".$level." a bien été supprimé.");

      return $this->redirectToRoute('her_general_spell_single', array(
        'slug' => $slug,
      ));
    }

    return $this->render('HerItemsBundle:Spell:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
