<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\TownHall;
use Her\ItemsBundle\Entity\Batiment;
use Her\ItemsBundle\Form\TownHallType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class TownHallController extends Controller
{
    public function indexAction()
    {
      $em = $this
      ->getDoctrine()
      ->getManager();
      $singles = $em->getRepository('HerItemsBundle:TownHall')->orderByLevel();
      $general = $singles[0]->getBatiment();

      if (null === $singles) {
        throw new NotFoundHttpException("Aucun Hotel de Ville n'est répertorié.");
      } else {
        return $this->render('HerItemsBundle:TownHall:index.html.twig',array(
          'singles' => $singles,
          'general'  => $general,
        ));
      }
    }

    public function singleAction($level)
    {
      $em = $this
      ->getDoctrine()
      ->getManager();

      $single = $em->getRepository('HerItemsBundle:TownHall')->findOneBy(array('level' => $level));

      if (null === $single) {
        throw new NotFoundHttpException("La Caserne niveau .$level. n'est pas encore répertoriée.");
      } else {
        $best = $em->getRepository('HerItemsBundle:TownHall')->findOneBy(array('level' => $single->getBatiment()->getMaxLevel() ) );

        $formatDuration = $this->container->get('her_items.services');
        $improvementDuration = $single->getImprovementDuration();

        $formattedDuration = $formatDuration->durationSec($improvementDuration);

        return $this->render('HerItemsBundle:TownHall:single.html.twig',array(
          'single'   => $single,
          'best'     => $best,
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
      $em = $this->getDoctrine()->getManager();

      $single = new TownHall();
      $single->setBatiment($batiment);
      $form   = $this->get('form.factory')->create(TownHallType::class, $single);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em->persist($single);
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Hotel de Ville bien enregistré.');

        return $this->redirectToRoute('her_town_hall_single', array('level' => $single->getLevel()));
      }

      return $this->render('HerItemsBundle:TownHall:add.html.twig', array(
        'form' => $form->createView(),
      ));
    }

    /**
     * @Security("has_role('ROLE_ADMIN')")
     */
    public function editAction($level, Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $single = $em->getRepository('HerItemsBundle:TownHall')->findOneBy(array('level'=>$level));

      if (null === $single) {
        throw new NotFoundHttpException("L'Hotel de Ville niveau ".$level." n'est pas répertorié");
      }

      $form = $this->get('form.factory')->create(TownHallType::class, $single);

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        // Inutile de persister ici, Doctrine connait déjà notre annonce
        $em->flush();

        $request->getSession()->getFlashBag()->add('notice', 'Hotel de Ville bien modifié.');

        return $this->redirectToRoute('her_town_hall_single', array('level' => $single->getLevel()));
      }

      return $this->render('HerItemsBundle:TownHall:edit.html.twig', array(
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

      $single = $em->getRepository('HerItemsBundle:TownHall')->findOneBy(array('level'=>$level));

      if (null === $single) {
        throw new NotFoundHttpException("L'Hotel de Ville niveau ".$level." n'est pas répertorié");
      }

      // On crée un formulaire vide, qui ne contiendra que le champ CSRF
      // Cela permet de protéger la suppression d'annonce contre cette faille
      $form = $this->get('form.factory')->create();

      if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
        $em->remove($single);
        $em->flush();

        $request->getSession()->getFlashBag()->add('info', "L'Hotel de Ville a bien été supprimé.");

        return $this->redirectToRoute('her_town_hall_homepage');
      }

      return $this->render('HerItemsBundle:TownHall:delete.html.twig', array(
        'single' => $single,
        'form'   => $form->createView(),
      ));
    }
}
