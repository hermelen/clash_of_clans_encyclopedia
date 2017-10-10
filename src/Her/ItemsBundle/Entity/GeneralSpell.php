<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GeneralSpell
 *
 * @ORM\Table(name="coc_general_spell")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\GeneralSpellRepository")
 */
class GeneralSpell
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
     * @ORM\Column(name="damageArea", type="smallint")
     */
    private $damageArea;

    /**
     * @var string
     *
     * @ORM\Column(name="randomDamageArea", type="decimal", precision=4, scale=2, nullable = true)
     */
    private $randomDamageArea;

    /**
     * @var int
     *
     * @ORM\Column(name="space", type="smallint")
     */
    private $space;

    /**
     * @var int
     *
     * @ORM\Column(name="trainingDuration", type="integer")
     */
    private $trainingDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="actionDuration", type="integer", nullable = true)
     */
    private $actionDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="impulseNumber", type="integer", nullable = true)
     */
    private $impulseNumber;

    /**
     * @var decimal
     *
     * @ORM\Column(name="impulseDuration", type="decimal", precision=4, scale=2, nullable = true)
     */
    private $impulseDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="cloneDuration", type="integer", nullable = true)
     */
    private $cloneDuration;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text", nullable=true)
     */
    private $description;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TargetType")
    * @ORM\JoinColumn(nullable=true)
    */
    private $targetType;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Resource")
    * @ORM\JoinColumn(nullable=false)
    */
    private $resource;

    /**
    * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\Image", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $image;

    /**
    * @var int
    *
    * @ORM\Column(name="child", type="smallint", nullable=true)
    */
    private $child;

    /**
    * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\SpellFactory", cascade={"persist", "remove"}, mappedBy="generalSpell")
    * @ORM\JoinColumn(nullable=true)
    */
    private $spellFactory;


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
     * @return GeneralSpell
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
     * Set damageArea
     *
     * @param integer $damageArea
     *
     * @return GeneralSpell
     */
    public function setDamageArea($damageArea)
    {
        $this->damageArea = $damageArea;

        return $this;
    }

    /**
     * Get damageArea
     *
     * @return int
     */
    public function getDamageArea()
    {
        return $this->damageArea;
    }

    /**
     * Set randomDamageArea
     *
     * @param string $randomDamageArea
     *
     * @return GeneralSpell
     */
    public function setRandomDamageArea($randomDamageArea)
    {
        $this->randomDamageArea = $randomDamageArea;

        return $this;
    }

    /**
     * Get randomDamageArea
     *
     * @return string
     */
    public function getRandomDamageArea()
    {
        return $this->randomDamageArea;
    }

    /**
     * Set space
     *
     * @param integer $space
     *
     * @return GeneralSpell
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
     * Set trainingDuration
     *
     * @param integer $trainingDuration
     *
     * @return GeneralSpell
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
     * Set actionDuration
     *
     * @param integer $actionDuration
     *
     * @return GeneralSpell
     */
    public function setActionDuration($actionDuration)
    {
        $this->actionDuration = $actionDuration;

        return $this;
    }

    /**
     * Get actionDuration
     *
     * @return int
     */
    public function getActionDuration()
    {
        return $this->actionDuration;
    }

    /**
     * Set cloneDuration
     *
     * @param integer $cloneDuration
     *
     * @return GeneralSpell
     */
    public function setCloneDuration($cloneDuration)
    {
        $this->cloneDuration = $cloneDuration;

        return $this;
    }

    /**
     * Get cloneDuration
     *
     * @return int
     */
    public function getCloneDuration()
    {
        return $this->cloneDuration;
    }

    /**
     * Set maxLevel
     *
     * @param integer $maxLevel
     *
     * @return GeneralSpell
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
     * Set child
     *
     * @param integer $child
     *
     * @return GeneralSpell
     */
    public function setChild($child)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child
     *
     * @return integer
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * Set targetType
     *
     * @param \Her\ItemsBundle\Entity\TargetType $targetType
     *
     * @return GeneralSpell
     */
    public function setTargetType(\Her\ItemsBundle\Entity\TargetType $targetType = null)
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
     * Set resource
     *
     * @param \Her\ItemsBundle\Entity\Resource $resource
     *
     * @return GeneralSpell
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
     * Set image
     *
     * @param \Her\ItemsBundle\Entity\Image $image
     *
     * @return GeneralSpell
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
     * Set impulseNumber
     *
     * @param integer $impulseNumber
     *
     * @return GeneralSpell
     */
    public function setImpulseNumber($impulseNumber)
    {
        $this->impulseNumber = $impulseNumber;

        return $this;
    }

    /**
     * Get impulseNumber
     *
     * @return integer
     */
    public function getImpulseNumber()
    {
        return $this->impulseNumber;
    }

    /**
     * Set impulseDuration
     *
     * @param string $impulseDuration
     *
     * @return GeneralSpell
     */
    public function setImpulseDuration($impulseDuration)
    {
        $this->impulseDuration = $impulseDuration;

        return $this;
    }

    /**
     * Get impulseDuration
     *
     * @return string
     */
    public function getImpulseDuration()
    {
        return $this->impulseDuration;
    }


    /**
     * Set spellFactory
     *
     * @param \Her\ItemsBundle\Entity\SpellFactory $spellFactory
     *
     * @return GeneralSpell
     */
    public function setSpellFactory(\Her\ItemsBundle\Entity\SpellFactory $spellFactory=null)
    {
        $this->spellFactory = $spellFactory;
        $spellFactory->setGeneralSpell($this);
        return $this;
    }

    /**
     * Get spellFactory
     *
     * @return \Her\ItemsBundle\Entity\SpellFactory
     */
    public function getSpellFactory()
    {
        return $this->spellFactory;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return GeneralSpell
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
     * @return GeneralSpell
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
