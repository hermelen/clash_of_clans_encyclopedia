<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Gedmo\Mapping\Annotation as Gedmo;//pour slug

/**
 * Batiment
 *
 * @ORM\Table(name="coc_batiment")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\BatimentRepository")
 */
class Batiment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    //   /**
    //  * @Gedmo\Slug(fields={"name"})
    //  * @ORM\Column(name="slug", type="string", length=255, unique=true)
    //  */
    // private $slug;

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
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Resource")
    * @ORM\JoinColumn(nullable=false)
    */
    private $resource;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\TownHallAvailability", mappedBy="batiment", cascade={"persist", "remove"})
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
     * @return Batiment
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
     * Set description
     *
     * @param string $description
     *
     * @return Batiment
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
     * Set resource
     *
     * @param \Her\ItemsBundle\Entity\Resource $resource
     *
     * @return Batiment
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
     * Set maxLevel
     *
     * @param integer $maxLevel
     *
     * @return Batiment
     */
    public function setMaxLevel($maxLevel)
    {
        $this->maxLevel = $maxLevel;

        return $this;
    }

    /**
     * Get maxLevel
     *
     * @return integer
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
     * @return Batiment
     */
    public function setSpace($space)
    {
        $this->space = $space;

        return $this;
    }

    /**
     * Get space
     *
     * @return integer
     */
    public function getSpace()
    {
        return $this->space;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->townHallAvailabilities = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add townHallAvailability
     *
     * @param \Her\ItemsBundle\Entity\TownHallAvailability $townHallAvailability
     *
     * @return Batiment
     */
    public function addTownHallAvailability(\Her\ItemsBundle\Entity\TownHallAvailability $townHallAvailability)
    {
        $this->townHallAvailabilities[] = $townHallAvailability;
        $townHallAvailability->setBatiment($this);
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
     * Set slug
     *
     * @param string $slug
     *
     * @return Batiment
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
     * Set offensiveStrategy
     *
     * @param string $offensiveStrategy
     *
     * @return Batiment
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
     * @return Batiment
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
     * @return Batiment
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
