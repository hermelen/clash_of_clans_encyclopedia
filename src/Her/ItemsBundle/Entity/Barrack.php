<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Barrack
 *
 * @ORM\Table(name="coc_barrack")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\BarrackRepository")
 */
class Barrack
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
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\Image", cascade={"persist", "remove"})
     */
    private $image;

    /**
     * @var int
     *
     * @ORM\Column(name="level", type="smallint", unique=true)
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="improvement_cost", type="integer")
     */
    private $improvementCost;

    /**
     * @var int
     *
     * @ORM\Column(name="improvement_duration", type="integer")
     */
    private $improvementDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="exp", type="integer")
     */
    private $exp;

    /**
     * @var int
     *
     * @ORM\Column(name="life", type="integer")
     */
    private $life;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TownHall", inversedBy = "barracks")
    * @ORM\JoinColumn(nullable=false)
    */
    private $townHall;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Batiment")
     */
    private $batiment;

    /**
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\GeneralTroop", mappedBy="barrack", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $generalTroop;




    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set level
     *
     * @param integer $level
     *
     * @return Barrack
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return int
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set improvementCost
     *
     * @param integer $improvementCost
     *
     * @return Barrack
     */
    public function setImprovementCost($improvementCost)
    {
        $this->improvementCost = $improvementCost;

        return $this;
    }

    /**
     * Get improvementCost
     *
     * @return int
     */
    public function getImprovementCost()
    {
        return $this->improvementCost;
    }

    /**
     * Set improvementDuration
     *
     * @param integer $improvementDuration
     *
     * @return Barrack
     */
    public function setImprovementDuration($improvementDuration)
    {
        $this->improvementDuration = $improvementDuration;

        return $this;
    }

    /**
     * Get improvementDuration
     *
     * @return int
     */
    public function getImprovementDuration()
    {
        return $this->improvementDuration;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     *
     * @return Barrack
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp
     *
     * @return int
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set life
     *
     * @param integer $life
     *
     * @return Barrack
     */
    public function setLife($life)
    {
        $this->life = $life;

        return $this;
    }

    /**
     * Get life
     *
     * @return int
     */
    public function getLife()
    {
        return $this->life;
    }




    /**
     * Set townHall
     *
     * @param \Her\ItemsBundle\Entity\TownHall $townHall
     *
     * @return Barrack
     */
    public function setTownHall(\Her\ItemsBundle\Entity\TownHall $townHall)
    {
        $this->townHall = $townHall;

        return $this;
    }

    /**
     * Get townHall
     *
     * @return \Her\ItemsBundle\Entity\TownHall
     */
    public function getTownHall()
    {
        return $this->townHall;
    }

    /**
     * Set image
     *
     * @param \Her\ItemsBundle\Entity\Image $image
     *
     * @return Barrack
     */
    public function setImage(\Her\ItemsBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \Her\ItemsBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set batiment
     *
     * @param \Her\ItemsBundle\Entity\Batiment $batiment
     *
     * @return Barrack
     */
    public function setBatiment(\Her\ItemsBundle\Entity\Batiment $batiment = null)
    {
        $this->batiment = $batiment;

        return $this;
    }

    /**
     * Get batiment
     *
     * @return \Her\ItemsBundle\Entity\Batiment
     */
    public function getBatiment()
    {
        return $this->batiment;
    }

    /**
     * Set generalTroop
     *
     * @param \Her\ItemsBundle\Entity\GeneralTroop $generalTroop
     *
     * @return Barrack
     */
    public function setGeneralTroop(\Her\ItemsBundle\Entity\GeneralTroop $generalTroop = null)
    {
        $this->generalTroop = $generalTroop;
        
        return $this;
    }

    /**
     * Get generalTroop
     *
     * @return \Her\ItemsBundle\Entity\GeneralTroop
     */
    public function getGeneralTroop()
    {
        return $this->generalTroop;
    }
}
