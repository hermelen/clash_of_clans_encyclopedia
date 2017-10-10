<?php

namespace Her\ItemsBundle\Controller;

use Her\ItemsBundle\Entity\GeneralTroop;
use Her\ItemsBundle\Entity\GeneralSpell;
use Her\ItemsBundle\Entity\GeneralWeapon;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class NavController extends Controller
{
  public function navAction()
  {
    $em = $this
    ->getDoctrine()
    ->getManager();
    $navClassicTroops = $em->getRepository('HerItemsBundle:GeneralTroop')->orderedEntityBarrack();
    $navDarkTroops = $em->getRepository('HerItemsBundle:GeneralTroop')->orderedEntityDarkBarrack();
    $navHeroTroops = $em->getRepository('HerItemsBundle:GeneralTroop')->orderedEntityHero();
    $navClassicSpells = $em->getRepository('HerItemsBundle:GeneralSpell')->orderedEntityFactory(2);
    $navDarkSpells = $em->getRepository('HerItemsBundle:GeneralSpell')->orderedEntityFactory(3);
    $navWeapons = $em->getRepository('HerItemsBundle:GeneralWeapon')->orderedEntityType(2);
    $navTraps = $em->getRepository('HerItemsBundle:GeneralWeapon')->orderedEntityType(1);
    $navRamparts = $em->getRepository('HerItemsBundle:GeneralWeapon')->orderedEntityType(3);

    return $this->render('HerItemsBundle::nav.html.twig', array(
      'navClassicTroops' => $navClassicTroops,
      'navDarkTroops'    => $navDarkTroops,
      'navHeroTroops'    => $navHeroTroops,
      'navClassicSpells' => $navClassicSpells,
      'navDarkSpells'    => $navDarkSpells,
      'navWeapons'       => $navWeapons,
      'navTraps'         => $navTraps,
      'navRamparts'      => $navRamparts,
    ));
  }
}
