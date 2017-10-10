<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TroopType
 *
 * @ORM\Table(name="coc_troop_type")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\TroopTypeRepository")
 */
class TroopType
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
    * @ORM\OneToMany(targetEntity="Her\ItemsBundle\Entity\GeneralTroop", mappedBy = "troopType")
    * @ORM\JoinColumn(nullable=true)
    */
    private $generalTroops;


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
     * @return TroopType
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
     * Constructor
     */
    public function __construct()
    {
        $this->generalTroops = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add generalTroop
     *
     * @param \Her\ItemsBundle\Entity\GeneralTroop $generalTroop
     *
     * @return TroopType
     */
    public function addGeneralTroop(\Her\ItemsBundle\Entity\GeneralTroop $generalTroop)
    {
        $this->generalTroops[] = $generalTroop;
        $generalTroop->setTroopType($this);
        return $this;
    }

    /**
     * Remove generalTroop
     *
     * @param \Her\ItemsBundle\Entity\GeneralTroop $generalTroop
     */
    public function removeGeneralTroop(\Her\ItemsBundle\Entity\GeneralTroop $generalTroop)
    {
        $this->generalTroops->removeElement($generalTroop);
    }

    /**
     * Get generalTroops
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getGeneralTroops()
    {
        return $this->generalTroops;
    }
}
