<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * generalSpecialHero
 *
 * @ORM\Table(name="coc_general_special_hero")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\GeneralSpecialHeroRepository")
 */
class GeneralSpecialHero
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
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\SpecialHero", mappedBy = "generalSpecialHero")
    * @ORM\JoinColumn(nullable=true)
    */
    private $specialHeros;

    /**
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\GeneralTroop", mappedBy="generalSpecialHero", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $generalTroop;

    /**
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\GeneralTroop", cascade = {"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $childTroop;

    /**
    * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\Image", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $image;



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
     * @return generalSpecialHero
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
     * Set slug
     *
     * @param string $slug
     *
     * @return generalSpecialHero
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
     * Constructor
     */
    public function __construct()
    {
        $this->specialHeros = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add specialHero
     *
     * @param \Her\ItemsBundle\Entity\SpecialHero $specialHero
     *
     * @return GeneralSpecialHero
     */
    public function addSpecialHero(\Her\ItemsBundle\Entity\SpecialHero $specialHero)
    {
        $this->specialHeros[] = $specialHero;
        return $this;
    }

    /**
     * Remove specialHero
     *
     * @param \Her\ItemsBundle\Entity\SpecialHero $specialHero
     */
    public function removeSpecialHero(\Her\ItemsBundle\Entity\SpecialHero $specialHero)
    {
        $this->specialHeros->removeElement($specialHero);
    }

    /**
     * Get specialHeros
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpecialHeros()
    {
        return $this->specialHeros;
    }

    /**
     * Set maxLevel
     *
     * @param integer $maxLevel
     *
     * @return GeneralSpecialHero
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
     * Set description
     *
     * @param string $description
     *
     * @return GeneralSpecialHero
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
     * Set generalTroop
     *
     * @param \Her\ItemsBundle\Entity\GeneralTroop $generalTroop
     *
     * @return GeneralSpecialHero
     */
    public function setGeneralTroop(\Her\ItemsBundle\Entity\GeneralTroop $generalTroop)
    {
        $this->generalTroop = $generalTroop;
        $generalTroop->setGeneralSpecialHero($this);
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

    /**
     * Set childTroop
     *
     * @param \Her\ItemsBundle\Entity\GeneralTroop $childTroop
     *
     * @return GeneralSpecialHero
     */
    public function setChildTroop(\Her\ItemsBundle\Entity\GeneralTroop $childTroop = null)
    {
        $this->childTroop = $childTroop;

        return $this;
    }

    /**
     * Get childTroop
     *
     * @return \Her\ItemsBundle\Entity\GeneralTroop
     */
    public function getChildTroop()
    {
        return $this->childTroop;
    }

    /**
     * Set image
     *
     * @param \Her\ItemsBundle\Entity\Image $image
     *
     * @return GeneralSpecialHero
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
}
