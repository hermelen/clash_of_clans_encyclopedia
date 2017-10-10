<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Laboratory
 *
 * @ORM\Table(name="coc_laboratory")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\LaboratoryRepository")
 */
class Laboratory
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
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Image", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="level", type="string", length=255, unique=true)
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
     * @ORM\Column(name="exp", type="integer")
     */
    private $exp;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TownHall", inversedBy = "laboratories")
    * @ORM\JoinColumn(nullable=false)
    */
    private $townHall;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Batiment")
     */
    private $batiment;

    /**
     * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Troop", mappedBy = "laboratory")
     * @ORM\JoinColumn(nullable=true)
     */
    private $troops;

    /**
     * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\Spell", mappedBy = "laboratory")
     * @ORM\JoinColumn(nullable=true)
     */
    private $spells;

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
     * @param string $level
     *
     * @return Laboratory
     */
    public function setLevel($level)
    {
        $this->level = $level;

        return $this;
    }

    /**
     * Get level
     *
     * @return string
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
     * @return Laboratory
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
     * Set improvementCost
     *
     * @param integer $improvementCost
     *
     * @return Laboratory
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
     * @return Laboratory
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
     * Set image
     *
     * @param \Her\ItemsBundle\Entity\Image $image
     *
     * @return Laboratory
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
     * @return Laboratory
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
     * Set exp
     *
     * @param integer $exp
     *
     * @return Laboratory
     */
    public function setExp($exp)
    {
        $this->exp = $exp;

        return $this;
    }

    /**
     * Get exp
     *
     * @return integer
     */
    public function getExp()
    {
        return $this->exp;
    }

    /**
     * Set resource
     *
     * @param \Her\ItemsBundle\Entity\Resource $resource
     *
     * @return Laboratory
     */
    public function setResource(\Her\ItemsBundle\Entity\Resource $resource = null)
    {
        $this->resource = $resource;

        return $this;
    }

    /**
     * Set batiment
     *
     * @param \Her\ItemsBundle\Entity\Batiment $batiment
     *
     * @return Laboratory
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
        $this->troops = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add troop
     *
     * @param \Her\ItemsBundle\Entity\Troop $troop
     *
     * @return Laboratory
     */
    public function addTroop(\Her\ItemsBundle\Entity\Troop $troop)
    {
        $this->troops[] = $troop;
        $troop->setLaboratory(null);

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
     * Add spell
     *
     * @param \Her\ItemsBundle\Entity\Spell $spell
     *
     * @return Laboratory
     */
    public function addSpell(\Her\ItemsBundle\Entity\Spell $spell)
    {
        $this->spells[] = $spell;
        $spell->setLaboratory(null);
        return $this;
    }

    /**
     * Remove spell
     *
     * @param \Her\ItemsBundle\Entity\Spell $spell
     */
    public function removeSpell(\Her\ItemsBundle\Entity\Spell $spell)
    {
        $this->spells->removeElement($spell);
    }

    /**
     * Get spells
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSpells()
    {
        return $this->spells;
    }
}
