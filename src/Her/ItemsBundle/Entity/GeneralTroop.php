<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeneralTroop
 *
 * @ORM\Table(name="coc_general_troop")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\GeneralTroopRepository")
 */
class GeneralTroop
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
     * @ORM\Column(name="space", type="smallint", nullable=true)
     */
    private $space;

    /**
     * @var int
     *
     * @ORM\Column(name="speed", type="smallint")
     */
    private $speed;

    /**
     * @var int
     *
     * @ORM\Column(name="trainingDuration", type="integer", nullable=true)
     */
    private $trainingDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="offensive_strategy", type="text", nullable=true)
     */
    private $offensiveStrategy;

    /**
     * @var string
     *
     * @ORM\Column(name="defensive_strategy", type="text", nullable=true)
     */
    private $defensiveStrategy;

    /**
    * @var string
    *
    * @ORM\Column(name="other", type="text", nullable=true)
    */
    private $other;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\DamageType")
    * @ORM\JoinColumn(nullable=false)
    */
    private $damageType;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TargetType")
    * @ORM\JoinColumn(nullable=false)
    */
    private $targetType;

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
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\Barrack",inversedBy="generalTroop", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $barrack;

    /**
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\DarkBarrack",inversedBy="generalTroop", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $darkBarrack;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TroopType", inversedBy = "generalTroops")
    * @ORM\JoinColumn(nullable=true)
    */
    private $troopType;

    /**
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\GeneralSpecialHero",inversedBy="generalTroop", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $generalSpecialHero;

    /**
     * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Troop", mappedBy="generalTroop", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $troops;




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
     * @return GeneralTroop
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
     * @return GeneralTroop
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
     * @return GeneralTroop
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
     * @return GeneralTroop
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
     * Set trainingDuration
     *
     * @param integer $trainingDuration
     *
     * @return GeneralTroop
     */
    public function setTrainingDuration($trainingDuration)
    {
        $this->trainingDuration = $trainingDuration;

        return $this;
    }

    /**
     * Get trainingDuration
     *
     * @return int
     */
    public function getTrainingDuration()
    {
        return $this->trainingDuration;
    }

    /**
     * Set damageType
     *
     * @param \Her\ItemsBundle\Entity\DamageType $damageType
     *
     * @return GeneralTroop
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
     * Set targetType
     *
     * @param \Her\ItemsBundle\Entity\TargetType $targetType
     *
     * @return GeneralTroop
     */
    public function setTargetType(\Her\ItemsBundle\Entity\TargetType $targetType)
    {
        $this->targetType = $targetType;

        return $this;
    }

    /**
     * Get targetType
     *
     * @return \Her\ItemsBundle\Entity\TargetType
     */
    public function getTargetType()
    {
        return $this->targetType;
    }

    /**
     * Set targetZone
     *
     * @param \Her\ItemsBundle\Entity\TargetZone $targetZone
     *
     * @return GeneralTroop
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
     * Set resource
     *
     * @param \Her\ItemsBundle\Entity\Resource $resource
     *
     * @return GeneralTroop
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
     * Set barrack
     *
     * @param \Her\ItemsBundle\Entity\Barrack $barrack
     *
     * @return GeneralTroop
     */
    public function setBarrack(\Her\ItemsBundle\Entity\Barrack $barrack = null)
    {
        $this->barrack = $barrack;
        $barrack->setGeneralTroop(null);
        return $this;
    }

    /**
     * Get barrack
     *
     * @return \Her\ItemsBundle\Entity\Barrack
     */
    public function getBarrack()
    {
        return $this->barrack;
    }

    /**
     * Set darkBarrack
     *
     * @param \Her\ItemsBundle\Entity\DarkBarrack $darkBarrack
     *
     * @return GeneralTroop
     */
    public function setDarkBarrack(\Her\ItemsBundle\Entity\DarkBarrack $darkBarrack)
    {
        $this->darkBarrack = $darkBarrack;
        $darkBarrack->setGeneralTroop($this);
        return $this;
    }

    /**
     * Get darkBarrack
     *
     * @return \Her\ItemsBundle\Entity\DarkBarrack
     */
    public function getDarkBarrack()
    {
        return $this->darkBarrack;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return GeneralTroop
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
     * @return GeneralTroop
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

    /**
     * Set troopType
     *
     * @param \Her\ItemsBundle\Entity\TroopType $troopType
     *
     * @return GeneralTroop
     */
    public function setTroopType(\Her\ItemsBundle\Entity\TroopType $troopType = null)
    {
        $this->troopType = $troopType;

        return $this;
    }

    /**
     * Get troopType
     *
     * @return \Her\ItemsBundle\Entity\TroopType
     */
    public function getTroopType()
    {
        return $this->troopType;
    }

    /**
     * Set generalSpecialHero
     *
     * @param \Her\ItemsBundle\Entity\GeneralSpecialHero $generalSpecialHero
     *
     * @return GeneralTroop
     */
    public function setGeneralSpecialHero(\Her\ItemsBundle\Entity\GeneralSpecialHero $generalSpecialHero = null)
    {
        $this->generalSpecialHero = $generalSpecialHero;

        return $this;
    }

    /**
     * Get generalSpecialHero
     *
     * @return \Her\ItemsBundle\Entity\GeneralSpecialHero
     */
    public function getGeneralSpecialHero()
    {
        return $this->generalSpecialHero;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->troops = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add troop
     *
     * @param \Her\ItemsBundle\Entity\Troop $troop
     *
     * @return GeneralTroop
     */
    public function addTroop(\Her\ItemsBundle\Entity\Troop $troop)
    {
        $this->troops[] = $troop;
        $troop->setGeneralTroop($this);
        return $this;
    }

    /**
     * Remove troop
     *
     * @param \Her\ItemsBundle\Entity\Troop $troop
     */
    public function removeTroop(\Her\ItemsBundle\Entity\Troop $troop)
    {
        $this->troops->removeElement($troop);
    }

    /**
     * Get troops
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTroops()
    {
        return $this->troops;
    }

    /**
     * Set offensiveStrategy
     *
     * @param string $offensiveStrategy
     *
     * @return GeneralTroop
     */
    public function setOffensiveStrategy($offensiveStrategy)
    {
        $this->offensiveStrategy = $offensiveStrategy;

        return $this;
    }

    /**
     * Get offensiveStrategy
     *
     * @return string
     */
    public function getOffensiveStrategy()
    {
        return $this->offensiveStrategy;
    }

    /**
     * Set defensiveStrategy
     *
     * @param string $defensiveStrategy
     *
     * @return GeneralTroop
     */
    public function setDefensiveStrategy($defensiveStrategy)
    {
        $this->defensiveStrategy = $defensiveStrategy;

        return $this;
    }

    /**
     * Get defensiveStrategy
     *
     * @return string
     */
    public function getDefensiveStrategy()
    {
        return $this->defensiveStrategy;
    }

    /**
     * Set other
     *
     * @param string $other
     *
     * @return GeneralTroop
     */
    public function setOther($other)
    {
        $this->other = $other;

        return $this;
    }

    /**
     * Get other
     *
     * @return string
     */
    public function getOther()
    {
        return $this->other;
    }
}
