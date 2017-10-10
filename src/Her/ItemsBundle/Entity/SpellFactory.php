<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SpellFactory
 *
 * @ORM\Table(name="coc_spell_factory")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\SpellFactoryRepository")
 */
class SpellFactory
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
     * @ORM\Column(name="level", type="smallint")
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
     * @ORM\Column(name="capacity", type="smallint")
     */
    private $capacity;

    /**
     * @var int
     *
     * @ORM\Column(name="improvementCost", type="integer")
     */
    private $improvementCost;

    /**
     * @var int
     *
     * @ORM\Column(name="improvementDuration", type="integer")
     */
    private $improvementDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="speedUpCost", type="smallint")
     */
    private $speedUpCost;

    /**
     * @var int
     *
     * @ORM\Column(name="exp", type="integer")
     */
    private $exp;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TownHall", inversedBy="spellFactories")
    * @ORM\JoinColumn(nullable=false)
    */
    private $townHall;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Batiment")
    * @ORM\JoinColumn(nullable=false)
    */
    private $batiment;

    /**
    * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\GeneralSpell", cascade={"persist", "remove"}, inversedBy="spellFactory")
    * @ORM\JoinColumn(nullable=true)
    */
    private $generalSpell;





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
     * Set life
     *
     * @param integer $life
     *
     * @return SpellFactory
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
     * Set capacity
     *
     * @param integer $capacity
     *
     * @return SpellFactory
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return int
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set improvementCost
     *
     * @param integer $improvementCost
     *
     * @return SpellFactory
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
     * @return SpellFactory
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
     * Set speedUpCost
     *
     * @param integer $speedUpCost
     *
     * @return SpellFactory
     */
    public function setSpeedUpCost($speedUpCost)
    {
        $this->speedUpCost = $speedUpCost;

        return $this;
    }

    /**
     * Get speedUpCost
     *
     * @return int
     */
    public function getSpeedUpCost()
    {
        return $this->speedUpCost;
    }

    /**
     * Set exp
     *
     * @param integer $exp
     *
     * @return SpellFactory
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
     * Set townHall
     *
     * @param \Her\ItemsBundle\Entity\TownHall $townHall
     *
     * @return SpellFactory
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
     * Set level
     *
     * @param integer $level
     *
     * @return SpellFactory
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
     * Set batiment
     *
     * @param \Her\ItemsBundle\Entity\Batiment $batiment
     *
     * @return SpellFactory
     */
    public function setBatiment(\Her\ItemsBundle\Entity\Batiment $batiment)
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
     * Set image
     *
     * @param \Her\ItemsBundle\Entity\Image $image
     *
     * @return SpellFactory
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
     * Set generalSpell
     *
     * @param \Her\ItemsBundle\Entity\GeneralSpell $generalSpell
     *
     * @return SpellFactory
     */
    public function setGeneralSpell(\Her\ItemsBundle\Entity\GeneralSpell $generalSpell=null)
    {
        $this->generalSpell = $generalSpell;

        return $this;
    }

    /**
     * Get generalSpell
     *
     * @return \Her\ItemsBundle\Entity\GeneralSpell
     */
    public function getGeneralSpell()
    {
        return $this->generalSpell;
    }
}
