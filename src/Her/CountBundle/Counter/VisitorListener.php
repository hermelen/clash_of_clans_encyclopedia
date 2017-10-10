<?php

namespace Her\CountBundle\Counter;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

use Her\CountBundle\Entity\Visitor;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Cocur\Slugify\Slugify;

class VisitorListener
{
  protected $processeur;
  protected $visitor;
  protected $requestStack;

  public function __construct(VisitorCounter $processeur, RequestStack $requestStack)
  {
    $this->processeur = $processeur;
    $this->requestStack = $requestStack;
    $request = $this->requestStack->getCurrentRequest();

    $ip = $request->getClientIp();
    if($ip == 'unknown'){
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    if (!empty($_SERVER['HTTP_USER_AGENT'])){
       $HTTP_USER_AGENT = $_SERVER['HTTP_USER_AGENT'];
    }else if (!empty($HTTP_SERVER_VARS['HTTP_USER_AGENT'])){
       $HTTP_USER_AGENT = $HTTP_SERVER_VARS['HTTP_USER_AGENT'];
    }else if (!isset($HTTP_USER_AGENT)){
       $HTTP_USER_AGENT = '';
    }

    if (preg_match('/Opera(\/| )([0-9].[0-9]{1,2})/', $HTTP_USER_AGENT, $log_version)){
    // if (ereg('Opera(/| )([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)){
       $browser_version = $log_version[2];
       $browser_agent = 'opera';
    }else if (preg_match('/MSIE ([0-9].[0-9]{1,2})/', $HTTP_USER_AGENT, $log_version)){
    // }else if (ereg('MSIE ([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)){
       $browser_version = $log_version[1];
       $browser_agent = 'ie';
    }else if (preg_match('/OmniWeb\/([0-9].[0-9]{1,2})/', $HTTP_USER_AGENT, $log_version)){
      // }else if (ereg('OmniWeb/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)){
       $browser_version = $log_version[1];
       $browser_agent = 'omniweb';
    }else if (preg_match('/Netscape([0-9]{1})/', $HTTP_USER_AGENT, $log_version)){
    // }else if (ereg('Netscape([0-9]{1})', $HTTP_USER_AGENT, $log_version)){
       $browser_version = $log_version[1];
       $browser_agent = 'netscape';
    }else if (preg_match('/Mozilla\/([0-9].[0-9]{1,2})/', $HTTP_USER_AGENT, $log_version)){
    // }else if (ereg('Mozilla/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)){
       $browser_version = $log_version[1];
       $browser_agent = 'mozilla';
    }else if (preg_match('/Konqueror\/([0-9].[0-9]{1,2})/', $HTTP_USER_AGENT, $log_version)){
    // }else if (ereg('Konqueror/([0-9].[0-9]{1,2})', $HTTP_USER_AGENT, $log_version)){
       $browser_version = $log_version[1];
       $browser_agent = 'konqueror';
    }else{
       $browser_version = 0;
       $browser_agent = 'other';
    }

    $browser = $browser_agent;
    $hour = date("h");
    $minute = date("i");
    $day = date("d");
    $month = date("m");
    $year = date("y");
    if(!empty($_SERVER["HTTP_REFERER"])){
      $referer = $_SERVER["HTTP_REFERER"];
    }else{
      $referer = NULL;
    }
    // $referer = $request->get('http-referer');

    $s = empty($_SERVER["HTTPS"]) ? '' : ($_SERVER["HTTPS"] == "on") ? "s" : "";
    $protocol = substr(strtolower($_SERVER["SERVER_PROTOCOL"]), 0, strpos(strtolower($_SERVER["SERVER_PROTOCOL"]), "/")).$s;
    $port = ($_SERVER["SERVER_PORT"] == "80") ? "" : (":".$_SERVER["SERVER_PORT"]);
    $page = $protocol."://".$_SERVER['SERVER_NAME'].$port.$_SERVER['REQUEST_URI'];

    $slugify = new Slugify();

    $visitor = new Visitor();
    $visitor->setIP($ip);
    $visitor->setBrowser($browser);
    $visitor->setHour($hour);
    $visitor->setMinute($minute);
    $visitor->setDay($day);
    $visitor->setMonth($month);
    $visitor->setYear($year);
    $visitor->setReferer($referer);
    $visitor->setPage($page);
    $visitor->setPageSlug($slugify->slugify($page));

    $this->visitor = $visitor;
  }

  public function processAddVisitor(FilterResponseEvent $event)
  {
    if (!$event->isMasterRequest()) {
      return;
    }

    $response = $this->processeur->addVisitor($event->getResponse(), $this->visitor);

    // $event->setResponse($response);
  }
}
