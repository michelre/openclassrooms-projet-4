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
    private $email;

    /**
     * @ORM\Column(type="datetime")
     */
    private $visitdate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $coderesa;

    /**
     * @ORM\Column(type="integer")
     */
    private $numberresa;

    public function getId()
    {
        return $this->id;
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

    public function getVisitdate(): ?\DateTimeInterface
    {
        return $this->visitdate;
    }

    public function setVisitdate(\DateTimeInterface $visitdate): self
    {
        $this->visitdate = $visitdate;

        return $this;
    }

    public function getCoderesa(): ?string
    {
        return $this->coderesa;
    }

    public function setCoderesa(string $coderesa): self
    {
        $this->coderesa = $coderesa;

        return $this;
    }

    public function getNumberresa(): ?int
    {
        return $this->numberresa;
    }

    public function setNumberresa(int $numberresa): self
    {
        $this->numberresa = $numberresa;

        return $this;
    }
}
