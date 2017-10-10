<?php

namespace Her\CountBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Her\CountBundle\Entity\Visitor;
use Her\CountBundle\Event\CountEvents;
use Her\CountBundle\Event\ClearVisitEvent;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

class CountController extends Controller
{
  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function indexAction($days, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $visits = $em->getRepository('HerCountBundle:Visitor')->youngerThan($days);
    $counter = count($visits);
    if (null === $visits) {
      throw new NotFoundHttpException("Aucune visite depuis ".$days." jours.");
    } else {
      return $this->render('HerCountBundle:Count:index.html.twig',array(
        'days'     => $days,
        'visits'   => $visits,
        'counter'  => $counter
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function indexIpAction($days, $ip, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $visits = $em->getRepository('HerCountBundle:Visitor')->byIp($days, $ip);
    $counter = count($visits);
    if (null === $visits) {
      throw new NotFoundHttpException("Aucune visite depuis ".$days." jours.");
    } else {
      return $this->render('HerCountBundle:Count:index.html.twig',array(
        'ip'       => $ip,
        'days'     => $days,
        'visits'   => $visits,
        'counter'  => $counter
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function indexPageAction($days, $pageSlug, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
    $visits = $em->getRepository('HerCountBundle:Visitor')->byPage($days, $pageSlug);
    $counter = count($visits);
    if (null === $visits) {
      throw new NotFoundHttpException("Aucune visite depuis ".$days." jours.");
    } else {
      return $this->render('HerCountBundle:Count:index.html.twig',array(
        'pageSlug'   => $pageSlug,
        'days'       => $days,
        'visits'     => $visits,
        'counter'    => $counter
      ));
    }
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function clearCountIndexAction()
  {
    return $this->render('HerCountBundle:Count:delete.html.twig');
  }

  /**
   * @Security("has_role('ROLE_ADMIN')")
   */
  public function clearCountAction($days, Request $request)
  {
    $em = $this->getDoctrine()->getManager();
      // On crée l'évènement  sans argument
      // $event = new ClearVisitEvent();
      // On déclenche l'évènement
      // $this->get('event_dispatcher')->dispatch(CountEvents::CLEAR_VISIT, $event);
      $visits = $em->getRepository('HerCountBundle:Visitor')->olderThan($days);
      foreach($visits as $visit){
        $em->remove($visit);
      }
      $em->flush();

      $request->getSession()->getFlashBag()->add(
        'info',
        "Visiteurs de plus de ".$days." jours supprimés, ".count($visits)." entrées supprimées."
      );
      return $this->redirectToRoute('her_count_show', array(
        'days' => 365,
      ));
  }

}
