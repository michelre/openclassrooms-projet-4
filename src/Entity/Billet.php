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
     * ORM\@OneToOne(targetEntity="Visitor", inversedBy="billet")
     * ORM\@JoinColumn(name="visitor_id", referencedColumnName="id")
     */
    private $visitor;

    /**
     * @return mixed
     */
    public function getVisitor()
    {
        return $this->visitor;
    }

    /**
     * @param mixed $visitor
     */
    public function setVisitor($visitor): void
    {
        $this->visitor = $visitor;
    }



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




}
