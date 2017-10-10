<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Troop
 *
 * @ORM\Table(name="coc_troop")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\TroopRepository")
 */
class Troop
{
  //GENERAL
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

  // BY LEVEL
    /**
     * @var int
     *
     * @ORM\Column(name="level", type="smallint")
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
     * @ORM\Column(name="improvement_duration", type="integer", nullable=true)
     */
    private $improvementDuration;

    /**
    * @var int
    *
    * @ORM\Column(name="damage", type="smallint")
    */
    private $damage;

    /**
    * @var int
    *
    * @ORM\Column(name="hit_damage", type="smallint", nullable=true)
    */
    private $hitDamage;

    /**
    * @var int
    *
    * @ORM\Column(name="life", type="smallint")
    */
    private $life;

    /**
    * @var int
    *
    * @ORM\Column(name="training_cost", type="integer", nullable=true)
    */
    private $trainingCost;

    /**
    * @var int
    *
    * @ORM\Column(name="healing_duration", type="integer", nullable=true)
    */
    private $healingDuration;

    /**
    * @var int
    *
    * @ORM\Column(name="child", type="smallint", nullable=true)
    */
    private $child;

    /**
    * @var int
    *
    * @ORM\Column(name="collateral", type="smallint", nullable=true)
    */
    private $collateral;

    /**
    * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\Image", cascade={"persist", "remove"})
    * @ORM\JoinColumn(nullable=true)
    */
    private $image;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Laboratory", inversedBy = "troops")
     * @ORM\JoinColumn(nullable=true)
     */
    private $laboratory;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TownHall", inversedBy = "troops", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $townHall;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\GeneralTroop", inversedBy = "troops", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $generalTroop;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\SpecialHero", inversedBy = "heroLevels", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $specialHero;

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
     * @return Troop
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
     * Set improvementCost
     *
     * @param integer $improvementCost
     *
     * @return Troop
     */
    public function setImprovementCost($improvementCost)
    {
        $this->improvementCost = $improvementCost;

        return $this;
    }

    /**
     * Get improvementCost
     *
     * @return integer
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
     * @return Troop
     */
    public function setImprovementDuration($improvementDuration)
    {
        $this->improvementDuration = $improvementDuration;

        return $this;
    }

    /**
     * Get improvementDuration
     *
     * @return integer
     */
    public function getImprovementDuration()
    {
        return $this->improvementDuration;
    }

    /**
     * Set damage
     *
     * @param integer $damage
     *
     * @return Troop
     */
    public function setDamage($damage)
    {
        $this->damage = $damage;

        return $this;
    }

    /**
     * Get damage
     *
     * @return integer
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
     * @return Troop
     */
    public function setHitDamage($hitDamage)
    {
        $this->hitDamage = $hitDamage;

        return $this;
    }

    /**
     * Get hitDamage
     *
     * @return integer
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
     * @return Troop
     */
    public function setLife($life)
    {
        $this->life = $life;

        return $this;
    }

    /**
     * Get life
     *
     * @return integer
     */
    public function getLife()
    {
        return $this->life;
    }

    /**
     * Set trainingCost
     *
     * @param integer $trainingCost
     *
     * @return Troop
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
     * Set child
     *
     * @param integer $child
     *
     * @return Troop
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
     * Set collateral
     *
     * @param integer $collateral
     *
     * @return Troop
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
     * Set laboratory
     *
     * @param \Her\ItemsBundle\Entity\Laboratory $laboratory
     *
     * @return Troop
     */
    public function setLaboratory(\Her\ItemsBundle\Entity\Laboratory $laboratory = null)
    {
        $this->laboratory = $laboratory;

        return $this;
    }

    /**
     * Get laboratory
     *
     * @return \Her\ItemsBundle\Entity\Laboratory
     */
    public function getLaboratory()
    {
        return $this->laboratory;
    }

    /**
     * Set image
     *
     * @param \Her\ItemsBundle\Entity\Image $image
     *
     * @return Troop
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
     * Set generalTroop
     *
     * @param \Her\ItemsBundle\Entity\GeneralTroop $generalTroop
     *
     * @return Troop
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

    /**
     * Set townHall
     *
     * @param \Her\ItemsBundle\Entity\TownHall $townHall
     *
     * @return Troop
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
     * Set healingDuration
     *
     * @param integer $healingDuration
     *
     * @return Troop
     */
    public function setHealingDuration($healingDuration)
    {
        $this->healingDuration = $healingDuration;

        return $this;
    }

    /**
     * Get healingDuration
     *
     * @return integer
     */
    public function getHealingDuration()
    {
        return $this->healingDuration;
    }

    /**
     * Set specialHero
     *
     * @param \Her\ItemsBundle\Entity\SpecialHero $specialHero
     *
     * @return Troop
     */
    public function setSpecialHero(\Her\ItemsBundle\Entity\SpecialHero $specialHero = null)
    {
        $this->specialHero = $specialHero;
        // $specialHero->addHeroLevel(null);
        return $this;
    }

    /**
     * Get specialHero
     *
     * @return \Her\ItemsBundle\Entity\SpecialHero
     */
    public function getSpecialHero()
    {
        return $this->specialHero;
    }
}
