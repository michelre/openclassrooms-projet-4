<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BilletRepository")
 */
class Billet
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
    private $type;

    /**
     * @ORM\Column(type="datetime")
     */
    private $visit_date;

    /**
     * @ORM\Column(type="boolean")
     */
    private $is_half;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Visitor", inversedBy="billet", cascade={"persist", "remove"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $visitor;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Tarif", mappedBy="billet", cascade={"persist", "remove"})
     */
    private $tarif;

   









    public function getId()
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getVisitDate(): ?\DateTimeInterface
    {
        return $this->visit_date;
    }

    public function setVisitDate(\DateTimeInterface $visit_date): self
    {
        $this->visit_date = $visit_date;

        return $this;
    }

    public function getIsHalf(): ?bool
    {
        return $this->is_half;
    }

    public function setIsHalf(bool $is_half): self
    {
        $this->is_half = $is_half;

        return $this;
    }

    public function getVisitor(): ?Visitor
    {
        return $this->visitor;
    }

    public function setVisitor(Visitor $visitor): self
    {
        $this->visitor = $visitor;

        return $this;
    }

    public function getTarif(): ?Tarif
    {
        return $this->tarif;
    }

    public function setTarif(Tarif $tarif): self
    {
        $this->tarif = $tarif;

        // set the owning side of the relation if necessary
        if ($this !== $tarif->getBillet()) {
            $tarif->setBillet($this);
        }

        return $this;
    }





   




}
