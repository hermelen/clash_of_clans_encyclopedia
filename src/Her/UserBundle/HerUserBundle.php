<?php

namespace Her\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class HerUserBundle extends Bundle
{
  public function getParent()
  {
    return 'FOSUserBundle';
  }

}
