<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TarifRepository")
 */
class Tarif
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Billet", inversedBy="tarif", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $billet;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Reservation", mappedBy="tarif", cascade={"persist", "remove"})
     */
    private $reservation;







    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getBillet(): ?Billet
    {
        return $this->billet;
    }

    public function setBillet(Billet $billet): self
    {
        $this->billet = $billet;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(Reservation $reservation): self
    {
        $this->reservation = $reservation;

        // set the owning side of the relation if necessary
        if ($this !== $reservation->getTarif()) {
            $reservation->setTarif($this);
        }

        return $this;
    }



}
