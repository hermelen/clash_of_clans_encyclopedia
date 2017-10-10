<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Weapon
 *
 * @ORM\Table(name="coc_weapon")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\WeaponRepository")
 */
class Weapon
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
     * @ORM\Column(name="level", type="smallint")
     */
    private $level;

    /**
     * @var int
     *
     * @ORM\Column(name="damagePerSecond", type="smallint", nullable = true)
     */
    private $damagePerSecond;

    /**
     * @var int
     *
     * @ORM\Column(name="damage", type="smallint", nullable = true)
     */
    private $damage;

    /**
     * @var int
     *
     * @ORM\Column(name="hitDamage", type="smallint", nullable = true)
     */
    private $hitDamage;

    /**
    * @var int
    *
    * @ORM\Column(name="collateral", type="smallint", nullable=true)
    */
    private $collateral;

    /**
     * @var int
     *
     * @ORM\Column(name="life", type="smallint", nullable = true)
     */
    private $life;

    /**
     * @var int
     *
     * @ORM\Column(name="improvementCost", type="integer", nullable = true)
     */
    private $improvementCost;

    /**
     * @var int
     *
     * @ORM\Column(name="improvementDuration", type="integer", nullable = true)
     */
    private $improvementDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="exp", type="smallint", nullable = true)
     */
    private $exp;

    /**
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable = true)
     */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\GeneralWeapon")
     * @ORM\JoinColumn(nullable=true)
     */
    private $generalWeapon;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TownHall", inversedBy = "weapons")
     * @ORM\JoinColumn(nullable=true)
     */
    private $townHall;

    /**
    * @var int
    *
    * @ORM\Column(name="child", type="smallint", nullable=true)
    */
    private $child;

    /**
    * @var int
    *
    * @ORM\Column(name="damageCapacity", type="smallint", nullable=true)
    */
    private $damageCapacity;

    /**
    * @var int
    *
    * @ORM\Column(name="trainingCost", type="integer", nullable=true)
    */
    private $trainingCost;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Resource")
    * @ORM\JoinColumn(nullable=true)
    */
    private $resource;


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
     * @return Weapon
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
     * Set damage
     *
     * @param integer $damage
     *
     * @return Weapon
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * Get damage
     *
     * @return int
     */
    public function getDamage()
    {
        return $this->damage;
    }

    /**
     * Set hitDamage
     *
     * @param integer $hitDamage
     *
     * @return Weapon
     */
    public function setHitDamage($hitDamage)
    {
        $this->hitDamage = $hitDamage;

        return $this;
    }

    /**
     * Get hitDamage
     *
     * @return int
     */
    public function getHitDamage()
    {
        return $this->hitDamage;
    }

    /**
     * Set life
     *
     * @param integer $life
     *
     * @return Weapon
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
     * Set improvementCost
     *
     * @param integer $improvementCost
     *
     * @return Weapon
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
     * @return Weapon
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
     * @return Weapon
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
     * Set generalWeapon
     *
     * @param \Her\ItemsBundle\Entity\GeneralWeapon $generalWeapon
     *
     * @return Weapon
     */
    public function setGeneralWeapon(\Her\ItemsBundle\Entity\GeneralWeapon $generalWeapon = null)
    {
        $this->generalWeapon = $generalWeapon;

        return $this;
    }

    /**
     * Get generalWeapon
     *
     * @return \Her\ItemsBundle\Entity\GeneralWeapon
     */
    public function getGeneralWeapon()
    {
        return $this->generalWeapon;
    }

    /**
     * Set collateral
     *
     * @param integer $collateral
     *
     * @return Weapon
     */
    public function setCollateral($collateral)
    {
        $this->collateral = $collateral;

        return $this;
    }

    /**
     * Get collateral
     *
     * @return integer
     */
    public function getCollateral()
    {
        return $this->collateral;
    }

    /**
     * Set townHall
     *
     * @param \Her\ItemsBundle\Entity\TownHall $townHall
     *
     * @return Weapon
     */
    public function setTownHall(\Her\ItemsBundle\Entity\TownHall $townHall = null)
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
     * Set child
     *
     * @param integer $child
     *
     * @return Weapon
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
     * Set damageCapacity
     *
     * @param integer $damageCapacity
     *
     * @return Weapon
     */
    public function setDamageCapacity($damageCapacity)
    {
        $this->damageCapacity = $damageCapacity;

        return $this;
    }

    /**
     * Get damageCapacity
     *
     * @return integer
     */
    public function getDamageCapacity()
    {
        return $this->damageCapacity;
    }

    /**
     * Set trainingCost
     *
     * @param integer $trainingCost
     *
     * @return Weapon
     */
    public function setTrainingCost($trainingCost)
    {
        $this->trainingCost = $trainingCost;

        return $this;
    }

    /**
     * Get trainingCost
     *
     * @return integer
     */
    public function getTrainingCost()
    {
        return $this->trainingCost;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Weapon
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set damagePerSecond
     *
     * @param integer $damagePerSecond
     *
     * @return Weapon
     */
    public function setDamagePerSecond($damagePerSecond)
    {
        $this->damagePerSecond = $damagePerSecond;

        return $this;
    }

    /**
     * Get damagePerSecond
     *
     * @return integer
     */
    public function getDamagePerSecond()
    {
        return $this->damagePerSecond;
    }

    /**
     * Set resource
     *
     * @param \Her\ItemsBundle\Entity\Resource $resource
     *
     * @return Weapon
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
}
