<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TownHall
 *
 * @ORM\Table(name="coc_town_hall")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\TownHallRepository")
 */
class TownHall
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
     * @ORM\Column(name="life", type="smallint")
     */
    private $life;

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
     * @ORM\Column(name="exp", type="smallint")
     */
    private $exp;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity_gold", type="integer")
     */
    private $capacityGold;

    /**
     * @var int
     *
     * @ORM\Column(name="capacity_dark", type="integer")
     */
    private $capacityDark;

    /**
     * @var int
     *
     * @ORM\Column(name="treasury_gold", type="integer")
     */
    private $treasuryGold;

    /**
     * @var int
     *
     * @ORM\Column(name="treasury_dark", type="integer")
     */
    private $treasuryDark;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Batiment")
     */
    private $batiment;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Barrack", mappedBy = "townHall")
    */
    private $barracks;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\DarkBarrack", mappedBy = "townHall")
    */
    private $darkBarracks;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Laboratory", mappedBy = "townHall")
    */
    private $laboratories;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Weapon", mappedBy = "townHall")
    */
    private $weapons;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\SpellFactory", mappedBy = "townHall")
    */
    private $spellFactories;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Prod", mappedBy = "townHall")
    */
    private $prods;

    /**
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Stock", mappedBy = "townHall")
    */
    private $stocks;

    /**
     * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Troop", mappedBy = "townHall")
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
     * Set level
     *
     * @param integer $level
     *
     * @return TownHall
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
     * Set life
     *
     * @param integer $life
     *
     * @return TownHall
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
     * @return TownHall
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
     * @return TownHall
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
     * @return TownHall
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
     * Set capacityGold
     *
     * @param integer $capacityGold
     *
     * @return TownHall
     */
    public function setCapacityGold($capacityGold)
    {
        $this->capacityGold = $capacityGold;

        return $this;
    }

    /**
     * Get capacityGold
     *
     * @return int
     */
    public function getCapacityGold()
    {
        return $this->capacityGold;
    }

    /**
     * Set capacityDark
     *
     * @param integer $capacityDark
     *
     * @return TownHall
     */
    public function setCapacityDark($capacityDark)
    {
        $this->capacityDark = $capacityDark;

        return $this;
    }

    /**
     * Get capacityDark
     *
     * @return int
     */
    public function getCapacityDark()
    {
        return $this->capacityDark;
    }

    /**
     * Set image
     *
     * @param \Her\ItemsBundle\Entity\Image $image
     *
     * @return TownHall
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
     * Set treasuryGold
     *
     * @param integer $treasuryGold
     *
     * @return TownHall
     */
    public function setTreasuryGold($treasuryGold)
    {
        $this->treasuryGold = $treasuryGold;

        return $this;
    }

    /**
     * Get treasuryGold
     *
     * @return integer
     */
    public function getTreasuryGold()
    {
        return $this->treasuryGold;
    }

    /**
     * Set treasuryDark
     *
     * @param integer $treasuryDark
     *
     * @return TownHall
     */
    public function setTreasuryDark($treasuryDark)
    {
        $this->treasuryDark = $treasuryDark;

        return $this;
    }

    /**
     * Get treasuryDark
     *
     * @return integer
     */
    public function getTreasuryDark()
    {
        return $this->treasuryDark;
    }

    /**
     * Set batiment
     *
     * @param \Her\ItemsBundle\Entity\Batiment $batiment
     *
     * @return TownHall
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
     * Constructor
     */
    public function __construct()
    {
        $this->barracks = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add barrack
     *
     * @param \Her\ItemsBundle\Entity\Barrack $barrack
     *
     * @return TownHall
     */
    public function addBarrack(\Her\ItemsBundle\Entity\Barrack $barrack)
    {
        $this->barracks[] = $barrack;
        $barrack->setTownHall($this);
        return $this;
    }

    /**
     * Remove barrack
     *
     * @param \Her\ItemsBundle\Entity\Barrack $barrack
     */
    public function removeBarrack(\Her\ItemsBundle\Entity\Barrack $barrack)
    {
        $this->barracks->removeElement($barrack);
    }

    /**
     * Get barracks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBarracks()
    {
        return $this->barracks;
    }

    /**
    * Add darkBarrack
    *
    * @param \Her\ItemsBundle\Entity\DarkBarrack $darkBarrack
    *
    * @return TownHall
    */
    public function addDarkBarrack(\Her\ItemsBundle\Entity\DarkBarrack $darkBarrack)
    {
      $this->darkBarracks[] = $darkBarrack;
      $darkBarrack->setTownHall($this);

      return $this;
    }

    /**
     * Remove darkBarrack
     *
     * @param \Her\ItemsBundle\Entity\DarkBarrack $darkBarrack
     */
    public function removeDarkBarrack(\Her\ItemsBundle\Entity\DarkBarrack $darkBarrack)
    {
        $this->darkBarracks->removeElement($darkBarrack);
    }

    /**
     * Get darkBarracks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDarkBarracks()
    {
        return $this->darkBarracks;
    }

    /**
     * Add laboratory
     *
     * @param \Her\ItemsBundle\Entity\Laboratory $laboratory
     *
     * @return TownHall
     */
    public function addLaboratory(\Her\ItemsBundle\Entity\Laboratory $laboratory)
    {
        $this->laboratories[] = $laboratory;
        $laboratory->setTownHall($this);

        return $this;
    }

    /**
     * Remove laboratory
     *
     * @param \Her\ItemsBundle\Entity\Laboratory $laboratory
     */
    public function removeLaboratory(\Her\ItemsBundle\Entity\Laboratory $laboratory)
    {
        $this->laboratories->removeElement($laboratory);
    }

    /**
     * Get laboratories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLaboratories()
    {
        return $this->laboratories;
    }

    /**
     * Add weapon
     *
     * @param \Her\ItemsBundle\Entity\Weapon $weapon
     *
     * @return TownHall
     */
    public function addWeapon(\Her\ItemsBundle\Entity\Weapon $weapon)
    {
        $this->weapons[] = $weapon;
        $weapon->setTownHall($this);

        return $this;
    }

    /**
     * Remove weapon
     *
     * @param \Her\ItemsBundle\Entity\Weapon $weapon
     */
    public function removeWeapon(\Her\ItemsBundle\Entity\Weapon $weapon)
    {
        $this->weapons->removeElement($weapon);
    }

    /**
     * Get weapons
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getWeapons()
    {
        return $this->weapons;
    }


    /**
     * Add spellFactory
     *
     * @param \Her\ItemsBundle\Entity\SpellFactory $spellFactory
     *
     * @return TownHall
     */
    public function addSpellFactory(\Her\ItemsBundle\Entity\SpellFactory $spellFactory)
    {
        $this->spellFactories[] = $spellFactory;
        $spellFactory->setTownHall($this);
        return $this;
    }

    /**
     * Remove spellFactory
     *
     * @param \Her\ItemsBundle\Entity\SpellFactory $spellFactory
     */
    public function removeSpellFactory(\Her\ItemsBundle\Entity\SpellFactory $spellFactory)
    {
        $this->spellFactories->removeElement($spellFactory);
    }

    /**
     * Get spellFactories
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpellFactories()
    {
        return $this->spellFactories;
    }

    /**
     * Add prod
     *
     * @param \Her\ItemsBundle\Entity\Prod $prod
     *
     * @return TownHall
     */
    public function addProd(\Her\ItemsBundle\Entity\Prod $prod)
    {
        $this->prods[] = $prod;
        $prod->setTownHall($this);
        return $this;
    }

    /**
     * Remove prod
     *
     * @param \Her\ItemsBundle\Entity\Prod $prod
     */
    public function removeProd(\Her\ItemsBundle\Entity\Prod $prod)
    {
        $this->prods->removeElement($prod);
    }

    /**
     * Get prods
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProds()
    {
        return $this->prods;
    }

    /**
     * Add stock
     *
     * @param \Her\ItemsBundle\Entity\Stock $stock
     *
     * @return TownHall
     */
    public function addStock(\Her\ItemsBundle\Entity\Stock $stock)
    {
        $this->stocks[] = $stock;
        $stock->setTownHall($this);
        return $this;
    }

    /**
     * Remove stock
     *
     * @param \Her\ItemsBundle\Entity\Stock $stock
     */
    public function removeStock(\Her\ItemsBundle\Entity\Stock $stock)
    {
        $this->stocks->removeElement($stock);
    }

    /**
     * Get stocks
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getStocks()
    {
        return $this->stocks;
    }

    /**
     * Add troop
     *
     * @param \Her\ItemsBundle\Entity\Troop $troop
     *
     * @return TownHall
     */
    public function addTroop(\Her\ItemsBundle\Entity\Troop $troop)
    {
        $this->troops[] = $troop;
        $troop->setTownHall(null);
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
}
