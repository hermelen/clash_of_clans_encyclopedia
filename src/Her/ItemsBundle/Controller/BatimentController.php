<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\Batiment;
use Her\ItemsBundle\Entity\TownHallAvailability;
use Her\ItemsBundle\Form\BatimentType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Cocur\Slugify\Slugify;

class BatimentController extends Controller
{
  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function indexAction()
  {
    $singles = $this
      ->getDoctrine()
      ->getManager()
      ->getRepository('HerItemsBundle:Batiment')
      ->orderAlpha();

      if (null === $singles) {
        throw new NotFoundHttpException("Aucun bâtiment n'est répertorié.");
      } else {
        return $this->render('HerItemsBundle:Batiment:index.html.twig',array(
          'singles' => $singles
        ));
      }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function addAction(Request $request)
  {
    $slugify = new Slugify();
    $single = new Batiment();

    $em = $this->getDoctrine()->getManager();
    $townHalls = $em->getRepository('HerItemsBundle:TownHall')->orderByLevel();


    foreach ($townHalls as $townHall){
      $townHallAvailability = new TownHallAvailability();
      $townHallAvailability->setTownHall($townHall);
      $single->addTownHallAvailability($townHallAvailability);
    }

    $form   = $this->get('form.factory')->create(BatimentType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $single->setSlug($slugify->slugify($single->getName()));

      $em->persist($single);
      $em->flush();

      $name = $single->getName();

      $request->getSession()->getFlashBag()->add('notice', $name.' bien enregistré.');

      return $this->redirectToRoute('her_batiment_homepage');
    }

    return $this->render('HerItemsBundle:Batiment:add.html.twig', array(
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

    $single = $em->getRepository('HerItemsBundle:Batiment')->findOneBy(array('slug'=>$slug));

    if (null === $single) {
      throw new NotFoundHttpException($slug." n'est pas répertorié");
    }

    $form = $this->get('form.factory')->create(BatimentType::class, $single);

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $single->setSlug($slugify->slugify($single->getName()));
      $em->flush();

      $request->getSession()->getFlashBag()->add('notice', $single->getName().' bien modifié.');

      return $this->redirectToRoute('her_batiment_homepage');
    }

    return $this->render('HerItemsBundle:Batiment:edit.html.twig', array(
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

    $single = $em->getRepository('HerItemsBundle:Batiment')->findOneBy(array(
      'slug'  => $slug,
    ));

    if (null === $single) {
      throw new NotFoundHttpException($slug." n'est pas répertorié");
    }

    // On crée un formulaire vide, qui ne contiendra que le champ CSRF
    // Cela permet de protéger la suppression d'annonce contre cette faille
    $form = $this->get('form.factory')->create();

    if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
      $em->remove($single);
      $em->flush();

      $request->getSession()->getFlashBag()->add('info', $slug."a bien été supprimé.");

      return $this->redirectToRoute('her_batiment_homepage', array(
        'slug' => $slug,
      ));
    }

    return $this->render('HerItemsBundle:Batiment:delete.html.twig', array(
      'single' => $single,
      'form'   => $form->createView(),
    ));
  }
}
