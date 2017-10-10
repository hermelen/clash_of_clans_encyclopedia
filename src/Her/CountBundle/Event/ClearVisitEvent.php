<?php
// src/Her/CountBundle/Event/ClearVisitEvent.php

namespace Her\CountBundle\Event;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

class ClearVisitEvent extends Event
{
  protected $inputData;

  public function getInputData()
  {
    return $this->inputData;
  }

  public function newUrlGetter($inputData, Request $request)
  {
    $inputData = $request->get('inputData');
  }
}
