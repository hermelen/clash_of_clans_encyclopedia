<?php
// src/Her/countBundle/BigBrother/ClearVisitListener.php

namespace Her\CountBundle\Bigbrother;

use Her\CountBundle\Event\ClearVisitEvent;

class ClearVisitListener
{
  protected $inpuData;

  public function __construct(newUrlGetter $inpuData)
  {
    $this->inpuData = $inpuData;
  }

  public function processClearVisit(newUrlGetter $event)
  {
    // // On active la surveillance si l'auteur du message est dans la liste
    // if (in_array($event->getUser()->getUsername(), $this->listUsers)) {
    //   // On envoie un e-mail à l'administrateur
    //   $this->notificator->notifyByEmail($event->getMessage(), $event->getUser());
    // }
    // $url = $request->get('url');
  }
}
