<?php

namespace Her\CountBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Visitor
 *
 * @ORM\Table(name="coc_visitor")
 * @ORM\Entity(repositoryClass="Her\CountBundle\Repository\VisitorRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Visitor
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="ip", type="string", length=32, nullable=true)
     */
    private $ip;

    /**
     * @var int
     *
     * @ORM\Column(name="browser", type="string", length=255, nullable=true)
     */
    private $browser;

    /**
     * @var int
     *
     * @ORM\Column(name="hour", type="smallint")
     */
    private $hour;

    /**
     * @var int
     *
     * @ORM\Column(name="minute", type="smallint")
     */
    private $minute;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="date")
     */
    private $date;

    /**
     * @var int
     *
     * @ORM\Column(name="day", type="smallint")
     */
    private $day;

    /**
     * @var int
     *
     * @ORM\Column(name="month", type="smallint")
     */
    private $month;

    /**
     * @var int
     *
     * @ORM\Column(name="year", type="smallint")
     */
    private $year;

    /**
     * @var string
     *
     * @ORM\Column(name="referer", type="string", length=255, nullable=true)
     */
    private $referer;

    /**
     * @var string
     *
     * @ORM\Column(name="page", type="string", length=255, nullable=true)
     */
    private $page;

    /**
     * @var string
     *
     * @ORM\Column(name="page_slug", type="string", length=255, nullable=true)
     */
    private $pageSlug;

    public function __construct()
    {
      $this->date = new \Datetime();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set ip
     *
     * @param string $ip
     *
     * @return Visitor
     */
    public function setIp($ip)
    {
        $this->ip = $ip;

        return $this;
    }

    /**
     * Get ip
     *
     * @return string
     */
    public function getIp()
    {
        return $this->ip;
    }

    /**
     * Set browser
     *
     * @param string $browser
     *
     * @return Visitor
     */
    public function setBrowser($browser)
    {
        $this->browser = $browser;

        return $this;
    }

    /**
     * Get browser
     *
     * @return string
     */
    public function getBrowser()
    {
        return $this->browser;
    }

    /**
     * Set hour
     *
     * @param integer $hour
     *
     * @return Visitor
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return integer
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set minute
     *
     * @param integer $minute
     *
     * @return Visitor
     */
    public function setMinute($minute)
    {
        $this->minute = $minute;

        return $this;
    }

    /**
     * Get minute
     *
     * @return integer
     */
    public function getMinute()
    {
        return $this->minute;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Visitor
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set day
     *
     * @param integer $day
     *
     * @return Visitor
     */
    public function setDay($day)
    {
        $this->day = $day;

        return $this;
    }

    /**
     * Get day
     *
     * @return integer
     */
    public function getDay()
    {
        return $this->day;
    }

    /**
     * Set month
     *
     * @param integer $month
     *
     * @return Visitor
     */
    public function setMonth($month)
    {
        $this->month = $month;

        return $this;
    }

    /**
     * Get month
     *
     * @return integer
     */
    public function getMonth()
    {
        return $this->month;
    }

    /**
     * Set year
     *
     * @param integer $year
     *
     * @return Visitor
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set referer
     *
     * @param string $referer
     *
     * @return Visitor
     */
    public function setReferer($referer)
    {
        $this->referer = $referer;

        return $this;
    }

    /**
     * Get referer
     *
     * @return string
     */
    public function getReferer()
    {
        return $this->referer;
    }

    /**
     * Set page
     *
     * @param string $page
     *
     * @return Visitor
     */
    public function setPage($page)
    {
        $this->page = $page;

        return $this;
    }

    /**
     * Get page
     *
     * @return string
     */
    public function getPage()
    {
        return $this->page;
    }

    /**
     * Set pageSlug
     *
     * @param string $pageSlug
     *
     * @return Visitor
     */
    public function setPageSlug($pageSlug)
    {
        $this->pageSlug = $pageSlug;

        return $this;
    }

    /**
     * Get pageSlug
     *
     * @return string
     */
    public function getPageSlug()
    {
        return $this->pageSlug;
    }
}
