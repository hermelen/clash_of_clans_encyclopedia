<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Spell
 *
 * @ORM\Table(name="coc_spell")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\SpellRepository")
 */
class Spell
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
     * @ORM\Column(name="damage", type="integer", nullable=true)
     */
    private $damage;

    /**
     * @var int
     *
     * @ORM\Column(name="trainingCost", type="integer")
     */
    private $trainingCost;

    /**
     * @var int
     *
     * @ORM\Column(name="improvementCost", type="integer", nullable=true)
     */
    private $improvementCost;

    /**
     * @var int
     *
     * @ORM\Column(name="improvementDuration", type="integer", nullable=true)
     */
    private $improvementDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="health", type="integer", nullable=true)
     */
    private $health;

    /**
     * @var int
     *
     * @ORM\Column(name="healthPerImpulse", type="integer", nullable=true)
     */
    private $healthPerImpulse;

    /**
     * @var int
     *
     * @ORM\Column(name="damageImprovement", type="integer", nullable=true)
     */
    private $damageImprovement;

    /**
     * @var int
     *
     * @ORM\Column(name="speedImprovement", type="integer", nullable=true)
     */
    private $speedImprovement;

    /**
     * @var decimal
     *
     * @ORM\Column(name="actionDuration",type="decimal", precision=4, scale=2, nullable=true)
     */
    private $actionDuration;

    /**
     * @var int
     *
     * @ORM\Column(name="child", type="smallint", nullable=true)
     */
    private $child;

    /**
     * @var int
     *
     * @ORM\Column(name="damagePerSecond", type="integer", nullable=true)
     */
    private $damagePerSecond;

    /**
     * @var int
     *
     * @ORM\Column(name="damagePerImpulse", type="integer", nullable=true)
     */
    private $damagePerImpulse;

    /**
     * @var int
     *
     * @ORM\Column(name="speedDecrease", type="integer", nullable=true)
     */
    private $speedDecrease;

    /**
     * @var int
     *
     * @ORM\Column(name="attackDecrease", type="integer", nullable=true)
     */
    private $attackDecrease;

    /**
     * @var int
     *
     * @ORM\Column(name="lifeDecrease", type="integer", nullable=true)
     */
    private $lifeDecrease;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\GeneralSpell")
     * @ORM\JoinColumn(nullable=true)
     */
    private $generalSpell;

    /**
     * @ORM\OneToOne(targetEntity="Her\ItemsBundle\Entity\SpellFactory")
     * @ORM\JoinColumn(nullable=true)
     */
    private $spellFactory;

    /**
     * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Laboratory", inversedBy = "spells")
     * @ORM\JoinColumn(nullable=true)
     */
    private $laboratory;


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
     * @return Spell
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
     * @return Spell
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
     * Set trainingCost
     *
     * @param integer $trainingCost
     *
     * @return Spell
     */
    public function setTrainingCost($trainingCost)
    {
        $this->trainingCost = $trainingCost;

        return $this;
    }

    /**
     * Get trainingCost
     *
     * @return int
     */
    public function getTrainingCost()
    {
        return $this->trainingCost;
    }

    /**
     * Set improvementCost
     *
     * @param integer $improvementCost
     *
     * @return Spell
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
     * @return Spell
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
     * Set health
     *
     * @param integer $health
     *
     * @return Spell
     */
    public function setHealth($health)
    {
        $this->health = $health;

        return $this;
    }

    /**
     * Get health
     *
     * @return int
     */
    public function getHealth()
    {
        return $this->health;
    }

    /**
     * Set damageImprovement
     *
     * @param integer $damageImprovement
     *
     * @return Spell
     */
    public function setDamageImprovement($damageImprovement)
    {
        $this->damageImprovement = $damageImprovement;

        return $this;
    }

    /**
     * Get damageImprovement
     *
     * @return int
     */
    public function getDamageImprovement()
    {
        return $this->damageImprovement;
    }

    /**
     * Set speedImprovement
     *
     * @param integer $speedImprovement
     *
     * @return Spell
     */
    public function setSpeedImprovement($speedImprovement)
    {
        $this->speedImprovement = $speedImprovement;

        return $this;
    }

    /**
     * Get speedImprovement
     *
     * @return int
     */
    public function getSpeedImprovement()
    {
        return $this->speedImprovement;
    }

    /**
     * Set actionDuration
     *
     * @param integer $actionDuration
     *
     * @return Spell
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
     * Set child
     *
     * @param integer $child
     *
     * @return Spell
     */
    public function setChild($child)
    {
        $this->child = $child;

        return $this;
    }

    /**
     * Get child
     *
     * @return int
     */
    public function getChild()
    {
        return $this->child;
    }

    /**
     * Set damagePerSecond
     *
     * @param integer $damagePerSecond
     *
     * @return Spell
     */
    public function setDamagePerSecond($damagePerSecond)
    {
        $this->damagePerSecond = $damagePerSecond;

        return $this;
    }

    /**
     * Get damagePerSecond
     *
     * @return int
     */
    public function getDamagePerSecond()
    {
        return $this->damagePerSecond;
    }

    /**
     * Set speedDecrease
     *
     * @param integer $speedDecrease
     *
     * @return Spell
     */
    public function setSpeedDecrease($speedDecrease)
    {
        $this->speedDecrease = $speedDecrease;

        return $this;
    }

    /**
     * Get speedDecrease
     *
     * @return int
     */
    public function getSpeedDecrease()
    {
        return $this->speedDecrease;
    }

    /**
     * Set attackDecrease
     *
     * @param integer $attackDecrease
     *
     * @return Spell
     */
    public function setAttackDecrease($attackDecrease)
    {
        $this->attackDecrease = $attackDecrease;

        return $this;
    }

    /**
     * Get attackDecrease
     *
     * @return int
     */
    public function getAttackDecrease()
    {
        return $this->attackDecrease;
    }

    /**
     * Set lifeDecrease
     *
     * @param integer $lifeDecrease
     *
     * @return Spell
     */
    public function setLifeDecrease($lifeDecrease)
    {
        $this->lifeDecrease = $lifeDecrease;

        return $this;
    }

    /**
     * Get lifeDecrease
     *
     * @return int
     */
    public function getLifeDecrease()
    {
        return $this->lifeDecrease;
    }

    /**
     * Set generalSpell
     *
     * @param \Her\ItemsBundle\Entity\GeneralSpell $generalSpell
     *
     * @return Spell
     */
    public function setGeneralSpell(\Her\ItemsBundle\Entity\GeneralSpell $generalSpell = null)
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

    /**
     * Set damagePerImpulse
     *
     * @param integer $damagePerImpulse
     *
     * @return Spell
     */
    public function setDamagePerImpulse($damagePerImpulse)
    {
        $this->damagePerImpulse = $damagePerImpulse;

        return $this;
    }

    /**
     * Get damagePerImpulse
     *
     * @return integer
     */
    public function getDamagePerImpulse()
    {
        return $this->damagePerImpulse;
    }

    /**
     * Set healthPerImpulse
     *
     * @param integer $healthPerImpulse
     *
     * @return Spell
     */
    public function setHealthPerImpulse($healthPerImpulse)
    {
        $this->healthPerImpulse = $healthPerImpulse;

        return $this;
    }

    /**
     * Get healthPerImpulse
     *
     * @return integer
     */
    public function getHealthPerImpulse()
    {
        return $this->healthPerImpulse;
    }

    /**
     * Set spellFactory
     *
     * @param \Her\ItemsBundle\Entity\SpellFactory $spellFactory
     *
     * @return Spell
     */
    public function setSpellFactory(\Her\ItemsBundle\Entity\SpellFactory $spellFactory = null)
    {
        $this->spellFactory = $spellFactory;

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
     * Set laboratory
     *
     * @param \Her\ItemsBundle\Entity\Laboratory $laboratory
     *
     * @return Spell
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
}
