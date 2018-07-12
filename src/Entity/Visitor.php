<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
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
     */
    private $last_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Type("string")
     */
    private $first_name;

    /**
     * @ORM\Column(type="string", length=255)
     * @Type("string")
     */
    private $country;

    /**
     * @ORM\Column(type="datetime")
     * @Type("DateTime")
     */
    private $birthdate;

    /**
     * @ORM\Column(type="string", length=255)
     * @Type("string")
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Billet", mappedBy="visitor", cascade={"persist", "remove"})
     * @Type("App\Entity\Billet")
     */
    private $billet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Reservation", inversedBy="Visitors")
     * @ORM\JoinColumn(nullable=false)
     */
    private $reservation;


 
    public function getId()
    {
        return $this->id;
    }

    public function getLastName(): ?string
    {
        return $this->last_name;
    }

    public function setLastName(string $last_name): self
    {
        $this->last_name = $last_name;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->first_name;
    }

    public function setFirstName(string $first_name): self
    {
        $this->first_name = $first_name;

        return $this;
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

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getBillet(): ?Billet
    {
        return $this->billet;
    }

    public function setBillet(Billet $billet): self
    {
        $this->billet = $billet;

        // set the owning side of the relation if necessary
        if ($this !== $billet->getVisitor()) {
            $billet->setVisitor($this);
        }

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    
}
