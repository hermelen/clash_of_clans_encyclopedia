<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Spell;
use Her\ItemsBundle\Entity\GeneralSpell;
use Her\ItemsBundle\Form\GeneralSpellType;
use Her\ItemsBundle\Form\GeneralSpellEditType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Her\ItemsBundle\Repository\GeneralSpellRepository;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Cocur\Slugify\Slugify;

class GeneralSpellController extends Controller
{
  public function indexAction()
  {
    $singleRepository = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:GeneralSpell');
    $singles = $singleRepository->findAll();

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun sort n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:GeneralSpell:index.html.twig',array(
        'singles' => $singles
      ));
    }
  }

  public function indexClassicAction()
  {
    $em = $this->getDoctrine()->getManager();

    $singleRepository = $em->getRepository('HerItemsBundle:GeneralSpell');
    $singles = $singleRepository->findBy(array(
      'resource' => 2
    ));

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun sort classique n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:GeneralSpell:index.html.twig',array(
        'singles' => $singles
      ));
    }
  }

  public function indexDarkAction()
  {
    $em = $this->getDoctrine()->getManager();

    $singleRepository = $em->getRepository('HerItemsBundle:GeneralSpell');
    $singles = $singleRepository->findBy(array(
      'resource' => 3
    ));

    if (null === $singles) {
      throw new NotFoundHttpException("Aucun sort noir n'est répertorié.");
    } else {
      return $this->render('HerItemsBundle:GeneralSpell:index.html.twig',array(
        'singles' => $singles
      ));
    }
  }

  public function singleAction($slug)
  {
    $em = $this
      ->getDoctrine()
      ->getManager();

    // $allSpells = $em->getRepository('HerItemsBundle:GeneralSpell')->findAll();

    $single = $em->getRepository('HerItemsBundle:GeneralSpell')->findOneBy(array(
      'slug' => $slug));

    if (null === $single) {
      throw new NotFoundHttpException("Le sort ".$slug." n'est pas encore répertorié.");
    } else {

      $formatDuration = $this->container->get('her_items.services');
      $trainingDuration = $single->getTrainingDuration();
      $trainingDuration_4 = $formatDuration->durationSec($trainingDuration);

      return $this->render('HerItemsBundle:GeneralSpell:single.html.twig',array(
        'single'       => $single,
        'trainingDuration_4' => $trainingDuration_4,
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function addAction(Request $request)
  {
    $slugify = new Slugify();
    $single = new GeneralSpell();
    $em = $this->getDoctrine()->getManager();
    $form   = $this->get('form.factory')->create(GeneralSpellType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $single->setSlug($slugify->slugify($single->getName()));
      $em->persist($single);
      $em->flush();

      $name = $single->getName();

      $request->getSession()->getFlashBag()->add('notice', $name.' bien enregistré.');

      return $this->redirectToRoute('her_general_spell_single', array(
        'slug' => $slug,
      ));
    }

    return $this->render('HerItemsBundle:GeneralSpell:add.html.twig', array(
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

    $single = $em->getRepository('HerItemsBundle:GeneralSpell')->findOneBy(array('slug'=>$slug));

    if (null === $single) {
      throw new NotFoundHttpException($slug." n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(GeneralSpellType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $single->setSlug($slugify->slugify($single->getName()));
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $single->getName().' bien modifié.');

      return $this->redirectToRoute('her_general_spell_single', array(
        'slug' => $single->getSlug(),
      ));
    }

    return $this->render('HerItemsBundle:GeneralSpell:edit.html.twig', array(
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

    $single = $em->getRepository('HerItemsBundle:GeneralSpell')->findOneBy(array(
      'slug'  => $slug,
    ));

    if (null === $single) {
      throw new NotFoundHttpException($slug."n'est pas répertorié");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', $slug."a bien été supprimé.");

      return $this->redirectToRoute('her_general_spell_homepage', array(
        'slug' => $slug,
      ));
    }

    return $this->render('HerItemsBundle:GeneralSpell:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
