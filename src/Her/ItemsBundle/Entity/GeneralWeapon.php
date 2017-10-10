<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeneralWeapon
 *
 * @ORM\Table(name="coc_general_weapon")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\GeneralWeaponRepository")
 */
class GeneralWeapon
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var int
     *
     * @ORM\Column(name="maxLevel", type="smallint")
     */
    private $maxLevel;

    /**
     * @var int
     *
     * @ORM\Column(name="space", type="smallint")
     */
    private $space;

    /**
     * @var int
     *
     * @ORM\Column(name="speed", type="smallint")
     */
    private $speed;

    /**
     * @var decimal
     *
     * @ORM\Column(name="damageArea", type="decimal", precision=4, scale=2)
     */
    private $damageArea;

    /**
     * @var decimal
     *
     * @ORM\Column(name="activationArea", type="decimal", precision=4, scale=2)
     */
    private $activationArea;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\DamageType")
    * @ORM\JoinColumn(nullable=false)
    */
    private $damageType;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TargetZone")
    * @ORM\JoinColumn(nullable=false)
    */
    private $targetZone;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Resource")
    * @ORM\JoinColumn(nullable=false)
    */
    private $resource;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Defense")
    * @ORM\JoinColumn(nullable=true)
    */
    private $defense;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\TownHallAvailability", mappedBy="generalWeapon", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=false)
    */
    private $townHallAvailabilities;



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
     * Set name
     *
     * @param string $name
     *
     * @return GeneralWeapon
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set maxLevel
     *
     * @param integer $maxLevel
     *
     * @return GeneralWeapon
     */
    public function setMaxLevel($maxLevel)
    {
        $this->maxLevel = $maxLevel;

        return $this;
    }

    /**
     * Get maxLevel
     *
     * @return int
     */
    public function getMaxLevel()
    {
        return $this->maxLevel;
    }

    /**
     * Set space
     *
     * @param integer $space
     *
     * @return GeneralWeapon
     */
    public function setSpace($space)
    {
        $this->space = $space;

        return $this;
    }

    /**
     * Get space
     *
     * @return int
     */
    public function getSpace()
    {
        return $this->space;
    }

    /**
     * Set speed
     *
     * @param integer $speed
     *
     * @return GeneralWeapon
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;

        return $this;
    }

    /**
     * Get speed
     *
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * Set damageArea
     *
     * @param integer $damageArea
     *
     * @return GeneralWeapon
     */
    public function setDamageArea($damageArea)
    {
        $this->damageArea = $damageArea;

        return $this;
    }

    /**
     * Get damageArea
     *
     * @return integer
     */
    public function getDamageArea()
    {
        return $this->damageArea;
    }

    /**
     * Set damageType
     *
     * @param \Her\ItemsBundle\Entity\DamageType $damageType
     *
     * @return GeneralWeapon
     */
    public function setDamageType(\Her\ItemsBundle\Entity\DamageType $damageType)
    {
        $this->damageType = $damageType;

        return $this;
    }

    /**
     * Get damageType
     *
     * @return \Her\ItemsBundle\Entity\DamageType
     */
    public function getDamageType()
    {
        return $this->damageType;
    }

    /**
     * Set targetZone
     *
     * @param \Her\ItemsBundle\Entity\TargetZone $targetZone
     *
     * @return GeneralWeapon
     */
    public function setTargetZone(\Her\ItemsBundle\Entity\TargetZone $targetZone)
    {
        $this->targetZone = $targetZone;

        return $this;
    }

    /**
     * Get targetZone
     *
     * @return \Her\ItemsBundle\Entity\TargetZone
     */
    public function getTargetZone()
    {
        return $this->targetZone;
    }

    /**
    * Constructor
    */
    public function __construct()
    {
      $this->townHallAvailabilites = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add townHallAvailability
     *
     * @param \Her\ItemsBundle\Entity\TownHallAvailability $townHallAvailability
     *
     * @return GeneralWeapon
     */
    public function addTownHallAvailability(\Her\ItemsBundle\Entity\TownHallAvailability $townHallAvailability)
    {
        $this->townHallAvailabilities[] = $townHallAvailability;
        $townHallAvailability->setGeneralWeapon($this);
        return $this;
    }

    /**
     * Remove townHallAvailability
     *
     * @param \Her\ItemsBundle\Entity\TownHallAvailability $townHallAvailability
     */
    public function removeTownHallAvailability(\Her\ItemsBundle\Entity\TownHallAvailability $townHallAvailability)
    {
        $this->townHallAvailabilities->removeElement($townHallAvailability);
    }

    /**
     * Get townHallAvailabilities
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTownHallAvailabilities()
    {
        return $this->townHallAvailabilities;
    }

    /**
     * Set resource
     *
     * @param \Her\ItemsBundle\Entity\Resource $resource
     *
     * @return GeneralWeapon
     */
    public function setResource(\Her\ItemsBundle\Entity\Resource $resource)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Get resource
     *
     * @return \Her\ItemsBundle\Entity\Resource
     */
    public function getResource()
    {
        return $this->resource;
    }

    /**
     * Set defense
     *
     * @param \Her\ItemsBundle\Entity\Defense $defense
     *
     * @return GeneralWeapon
     */
    public function setDefense(\Her\ItemsBundle\Entity\Defense $defense)
    {
        $this->defense = $defense;

        return $this;
    }

    /**
     * Get defense
     *
     * @return \Her\ItemsBundle\Entity\Defense
     */
    public function getDefense()
    {
        return $this->defense;
    }

    /**
     * Set activationArea
     *
     * @param string $activationArea
     *
     * @return GeneralWeapon
     */
    public function setActivationArea($activationArea)
    {
        $this->activationArea = $activationArea;

        return $this;
    }

    /**
     * Get activationArea
     *
     * @return string
     */
    public function getActivationArea()
    {
        return $this->activationArea;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return GeneralWeapon
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return GeneralWeapon
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }
}
