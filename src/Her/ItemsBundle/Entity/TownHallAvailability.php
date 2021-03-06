<?php

namespace Her\ItemsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TownHallAvailability
 *
 * @ORM\Table(name="coc_town_hall_availability")
 * @ORM\Entity(repositoryClass="Her\ItemsBundle\Repository\TownHallAvailabilityRepository")
 */
class TownHallAvailability
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
     * @ORM\Column(name="number", type="smallint")
     */
    private $number;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\TownHall")
    * @ORM\JoinColumn(nullable=false)
    */
    private $townHall;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\GeneralWeapon", inversedBy="townHallAvailabilities")
    * @ORM\JoinColumn(nullable=true)
    */
    private $generalWeapon;

    /**
    * @ORM\ManyToOne(targetEntity="Her\ItemsBundle\Entity\Batiment", inversedBy="townHallAvailabilities")
    * @ORM\JoinColumn(nullable=true)
    */
    private $batiment;


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
     * Set number
     *
     * @param integer $number
     *
     * @return TownHallAvailability
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set townHall
     *
     * @param \Her\ItemsBundle\Entity\TownHall $townHall
     *
     * @return TownHallAvailability
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
     * Set generalWeapon
     *
     * @param \Her\ItemsBundle\Entity\GeneralWeapon $generalWeapon
     *
     * @return TownHallAvailability
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
     * Set batiment
     *
     * @param \Her\ItemsBundle\Entity\Batiment $batiment
     *
     * @return TownHallAvailability
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
}
