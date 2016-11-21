<?php

namespace NB\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Travel
 *
 * @ORM\Table(name="travel")
 * @ORM\Entity(repositoryClass="NB\MainBundle\Repository\TravelRepository")
 */
class Travel
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
     * @ORM\ManyToOne(targetEntity="NB\MainBundle\Entity\Routes", cascade={"persist"})
     */
    private $route;

    /**
     * @ORM\ManyToOne(targetEntity="NB\MainBundle\Entity\Bus", cascade={"persist"})
     */
    private $bus;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="boarding_time", type="time")
     */
    private $boardingTime;

    /**
     * @var \Datetime
     *
     * @ORM\Column(name="arrival_time", type="time", length=12)
     */
    private $arrivalTime;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal", precision=10, scale=3)
     */
    private $price;

    /**
     * @var bool
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

    /**
     * @ORM\ManyToMany(targetEntity="NB\MainBundle\Entity\Frequency", cascade={"persist"})
     */
    private $frequency;

    protected $bookedSeats;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    public function __construct(){
        $this->frequency = new ArrayCollection();
    }
    public function setFrequency(Frequency $frequency = null)
    {
        $this->frequency = $frequency;
    }

    // Notez le singulier, on ajoute une seule catégorie à la fois
    public function addFrequency(Frequency $frequency)
    {
        // Ici, on utilise l'ArrayCollection vraiment comme un tableau
        $this->frequency[] = $frequency;

        return $this;
    }

    public function removeFrequency(Frequency $frequency)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la catégorie en argument
        $this->frequency->removeElement($frequency);
    }

    // Notez le pluriel, on récupère une liste de catégories ici !
    public function getFrequency()
    {
        return $this->frequency;
    }

    /**
     * Set route
     *
     * @param string $route
     *
     * @return Travel
     */
    public function setRoute($route)
    {
        $this->route = $route;

        return $this;
    }

    /**
     * Get route
     *
     * @return string
     */
    public function getRoute()
    {
        return $this->route;
    }

    /**
     * Set bus
     *
     * @param string $bus
     *
     * @return Travel
     */
    public function setBus($bus)
    {
        $this->bus = $bus;

        return $this;
    }

    /**
     * Get bus
     *
     * @return string
     */
    public function getBus()
    {
        return $this->bus;
    }

    /**
     * Set boardingTime
     *
     * @param \DateTime $boardingTime
     *
     * @return Travel
     */
    public function setBoardingTime($boardingTime)
    {
        $this->boardingTime = $boardingTime;

        return $this;
    }

    /**
     * Get boardingTime
     *
     * @return \DateTime
     */
    public function getBoardingTime()
    {
        return $this->boardingTime;
    }

    /**
     * Set arrivalTime
     *
     * @param \DateTime $arrivalTime
     *
     * @return Travel
     */
    public function setArrivalTime($arrivalTime)
    {
        $this->arrivalTime = $arrivalTime;

        return $this;
    }

    /**
     * Get arrivalTime
     *
     * @return \DateTime
     */
    public function getArrivalTime()
    {
        return $this->arrivalTime;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Travel
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set active
     *
     * @param boolean $active
     *
     * @return Travel
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return bool
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Travel
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Travel
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param mixed $bookedSeats
     */
    public function setBookedSeats($bookedSeats)
    {
        $this->bookedSeats = $bookedSeats;
    }

    /**
     * @return mixed
     */
    public function getBookedSeats()
    {
        return $this->bookedSeats;
    }
}

