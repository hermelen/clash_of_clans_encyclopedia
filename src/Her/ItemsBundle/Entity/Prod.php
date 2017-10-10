<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Prod
 *
 * @ORM\Table(name="coc_prod")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\ProdRepository")
 */
class Prod
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
     * @ORM\Column(name="level", type="smallint", unique=false)
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="improvementCost", type="integer")
     */
    private $improvementCost;

    /**
     * @var int
     *
     * @ORM\Column(name="improvementDuration", type="integer")
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
     * @ORM\Column(name="capacity", type="integer")
     */
    private $capacity;

    /**
     * @var int
     *
     * @ORM\Column(name="productivity", type="integer")
     */
    private $productivity;

    /**
     * @var int
     *
     * @ORM\Column(name="life", type="integer")
     */
    private $life;

    /**
     * @var int
     *
     * @ORM\Column(name="full", type="integer")
     */
    private $full;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TownHall", inversedBy="prods")
    * @ORM\JoinColumn(nullable=false)
    */
    private $townHall;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Batiment")
    * @ORM\JoinColumn(nullable=false)
    */
    private $batiment;


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
     * @return Prod
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
     * @return Prod
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
     * @return Prod
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
     * @return Prod
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
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return Prod
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set productivity
     *
     * @param integer $productivity
     *
     * @return Prod
     */
    public function setProductivity($productivity)
    {
        $this->productivity = $productivity;

        return $this;
    }

    /**
     * Get productivity
     *
     * @return int
     */
    public function getProductivity()
    {
        return $this->productivity;
    }

    /**
     * Set life
     *
     * @param integer $life
     *
     * @return Prod
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
     * Set full
     *
     * @param integer $full
     *
     * @return Prod
     */
    public function setFull($full)
    {
        $this->full = $full;

        return $this;
    }

    /**
     * Get full
     *
     * @return int
     */
    public function getFull()
    {
        return $this->full;
    }

    /**
     * Set image
     *
     * @param \Her\ItemsBundle\Entity\Image $image
     *
     * @return Prod
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
     * Set townHall
     *
     * @param \Her\ItemsBundle\Entity\TownHall $townHall
     *
     * @return Prod
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
     * Set batiment
     *
     * @param \Her\ItemsBundle\Entity\Batiment $batiment
     *
     * @return Prod
     */
    public function setBatiment(\Her\ItemsBundle\Entity\Batiment $batiment)
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
}
