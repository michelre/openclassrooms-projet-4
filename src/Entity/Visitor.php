<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VisitorRepository")
 */
class Visitor
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Type("string")
     * @SerializedName("fullName")
     */
    private $fullName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Type("string")
     */
    private $country;

    /**
     * @ORM\Column(type="datetime")
     * @Type("DateTime<'d/m/Y'>")
     */
    private $birthdate;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Reservation", mappedBy="visitors")
     */
    private $reservations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tarif", inversedBy="visitors")
     * @ORM\JoinColumn(nullable=false)
     * @Type("App\Entity\Tarif")
     */
    private $tarif;

    public function __construct()
    {
        $this->reservations = new ArrayCollection();
    }


    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @param mixed $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }


    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getBithdate(): ?\DateTimeInterface
    {
        return $this->bithdate;
    }

    public function setBithdate(\DateTimeInterface $bithdate): self
    {
        $this->bithdate = $bithdate;

        return $this;
    }

    /**
     * @return Collection|Reservation[]
     */
    public function getReservations(): Collection
    {
        return $this->reservations;
    }

    public function addReservation(Reservation $reservation): self
    {
        if (!$this->reservations->contains($reservation)) {
            $this->reservations[] = $reservation;
            $reservation->addVisitor($this);
        }

        return $this;
    }

    public function removeReservation(Reservation $reservation): self
    {
        if ($this->reservations->contains($reservation)) {
            $this->reservations->removeElement($reservation);
            $reservation->removeVisitor($this);
        }

        return $this;
    }

    public function getTarif(): ?Tarif
    {
        return $this->tarif;
    }

    public function setTarif(?Tarif $tarif): self
    {
        $this->tarif = $tarif;

        return $this;
    }


}
