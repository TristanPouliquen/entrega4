<?php

namespace Entity37;

use Doctrine\ORM\Mapping as ORM;

/**
 * Reservation
 *
 * @ORM\Table(name="reserva", indexes={@ORM\Index(name="reserva_pkey", columns={"idreserva"})})
 * @ORM\Entity
 */
class Reservation
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idreserva", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="fecha", type="date")
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="hora", type="time without time zone")
     */
    private $time;

    /**
     * @var integer
     *
     * @ORM\Column(name="cantidad", type="integer")
     */
    private $quantity;

    /**
     * @var \Entity37\ReservationRestaurant
     *
     * @ORM\OneToOne(targetEntity="Entity37\ReservationRestaurant", mappedBy="reservation")
     */
    private $restaurantReservation;


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Reservation
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Reservation
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set time
     *
     * @param \DateTime $time
     *
     * @return Reservation
     */
    public function setTime($time)
    {
        $this->time = $time;

        return $this;
    }

    /**
     * Get time
     *
     * @return \DateTime
     */
    public function getTime()
    {
        return $this->time;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Reservation
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set restaurantReservation
     *
     * @param \Entity37\ReservationRestaurant $restaurantReservation
     *
     * @return Reservation
     */
    public function setRestaurantReservation(\Entity37\ReservationRestaurant $restaurantReservation = null)
    {
        $this->restaurantReservation = $restaurantReservation;

        return $this;
    }

    /**
     * Get restaurantReservation
     *
     * @return \Entity37\ReservationRestaurant
     */
    public function getRestaurantReservation()
    {
        return $this->restaurantReservation;
    }
}
