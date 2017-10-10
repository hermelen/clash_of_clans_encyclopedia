<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpecialHero
 *
 * @ORM\Table(name="coc_special_hero")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\SpecialHeroRepository")
 */
class SpecialHero
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
     * @ORM\Column(name="level", type="smallint", nullable=true)
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="damageImprovement", type="smallint", nullable=true)
     */
    private $damageImprovement;

    /**
     * @var int
     *
     * @ORM\Column(name="lifeImprovement", type="smallint", nullable=true)
     */
    private $lifeImprovement;

    /**
     * @var int
     *
     * @ORM\Column(name="speedImprovement", type="smallint", nullable=true)
     */
    private $speedImprovement;

    /**
     * @var int
     *
     * @ORM\Column(name="child", type="smallint", nullable=true)
     */
    private $child;

    /**
     * @var int
     *
     * @ORM\Column(name="specialDuration", type="integer")
     */
    private $specialDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="lifePercent", type="smallint", nullable=true)
     */
    private $lifePercent;

    /**
     * @var int
     *
     * @ORM\Column(name="maxLifeImprovement", type="smallint", nullable=true)
     */
    private $maxLifeImprovement;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\GeneralSpecialHero", inversedBy = "specialHeros")
    * @ORM\JoinColumn(nullable=false)
    */
    private $generalSpecialHero;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Troop", mappedBy = "specialHero" , cascade = {"persist", "remove"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $heroLevels;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->heroLevels = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set level
     *
     * @param integer $level
     *
     * @return SpecialHero
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return integer
     */
    public function getLevel()
    {
        return $this->level;
    }

    /**
     * Set damageImprovement
     *
     * @param integer $damageImprovement
     *
     * @return SpecialHero
     */
    public function setDamageImprovement($damageImprovement)
    {
        $this->damageImprovement = $damageImprovement;

        return $this;
    }

    /**
     * Get damageImprovement
     *
     * @return integer
     */
    public function getDamageImprovement()
    {
        return $this->damageImprovement;
    }

    /**
     * Set lifeImprovement
     *
     * @param integer $lifeImprovement
     *
     * @return SpecialHero
     */
    public function setLifeImprovement($lifeImprovement)
    {
        $this->lifeImprovement = $lifeImprovement;

        return $this;
    }

    /**
     * Get lifeImprovement
     *
     * @return integer
     */
    public function getLifeImprovement()
    {
        return $this->lifeImprovement;
    }

    /**
     * Set speedImprovement
     *
     * @param integer $speedImprovement
     *
     * @return SpecialHero
     */
    public function setSpeedImprovement($speedImprovement)
    {
        $this->speedImprovement = $speedImprovement;

        return $this;
    }

    /**
     * Get speedImprovement
     *
     * @return integer
     */
    public function getSpeedImprovement()
    {
        return $this->speedImprovement;
    }

    /**
     * Set child
     *
     * @param integer $child
     *
     * @return SpecialHero
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
     * Set specialDuration
     *
     * @param integer $specialDuration
     *
     * @return SpecialHero
     */
    public function setSpecialDuration($specialDuration)
    {
        $this->specialDuration = $specialDuration;

        return $this;
    }

    /**
     * Get specialDuration
     *
     * @return integer
     */
    public function getSpecialDuration()
    {
        return $this->specialDuration;
    }

    /**
     * Set lifePercent
     *
     * @param integer $lifePercent
     *
     * @return SpecialHero
     */
    public function setLifePercent($lifePercent)
    {
        $this->lifePercent = $lifePercent;

        return $this;
    }

    /**
     * Get lifePercent
     *
     * @return integer
     */
    public function getLifePercent()
    {
        return $this->lifePercent;
    }

    /**
     * Set maxLifeImprovement
     *
     * @param integer $maxLifeImprovement
     *
     * @return SpecialHero
     */
    public function setMaxLifeImprovement($maxLifeImprovement)
    {
        $this->maxLifeImprovement = $maxLifeImprovement;

        return $this;
    }

    /**
     * Get maxLifeImprovement
     *
     * @return integer
     */
    public function getMaxLifeImprovement()
    {
        return $this->maxLifeImprovement;
    }

    /**
     * Set generalSpecialHero
     *
     * @param \Her\ItemsBundle\Entity\GeneralSpecialHero $generalSpecialHero
     *
     * @return SpecialHero
     */
    public function setGeneralSpecialHero(\Her\ItemsBundle\Entity\GeneralSpecialHero $generalSpecialHero)
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
     * Add heroLevel
     *
     * @param \Her\ItemsBundle\Entity\Troop $heroLevel
     *
     * @return SpecialHero
     */
    public function addHeroLevel(\Her\ItemsBundle\Entity\Troop $heroLevel)
    {
        $this->heroLevels[] = $heroLevel;
        $heroLevel->setSpecialHero($this);
        return $this;
    }

    /**
     * Remove heroLevel
     *
     * @param \Her\ItemsBundle\Entity\Troop $heroLevel
     */
    public function removeHeroLevel(\Her\ItemsBundle\Entity\Troop $heroLevel)
    {
        $this->heroLevels->removeElement($heroLevel);
        $heroLevel->setSpecialHero(null);
    }

    /**
     * Get heroLevels
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getHeroLevels()
    {
        return $this->heroLevels;
    }
}
