<?php
namespace ItemsBundle\Twig;

class ItemsExtension extends \Twig_Extension
{
  public function getFilters()
  {
    return array(
      new \Twig_SimpleFilter('level', array($this, 'levelFilter')),
    );
  }

  public function levelFilter()
  {
    
  }
}
