<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation\SerializedName;
use JMS\Serializer\Annotation\Type;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReservationRepository")
 */
class Reservation
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     * @Type("DateTime<'d/m/Y'>")
     */
    private $creationDate;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     * @Type("string")
     */
    private $email;

    /**
     * @ORM\Column(type="datetime")
     * @SerializedName("visitDate")
     * @Type("DateTime<'d/m/Y'>")
     */
    private $visitDate;


    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Visitor", inversedBy="reservations", cascade={"persist"})
     * @Type("array<App\Entity\Visitor>")
     */
    private $visitors;

    /**
     * @ORM\Column(type="boolean")
     * @SerializedName("isHalf")
     * @Type("boolean")
     */
    private $isHalf;

    /**
     * @ORM\Column(type="boolean")
     * @SerializedName("isPayed")
     * @Type("boolean")
     */
    private $isPayed;


    public function __construct()
    {
        $this->visitors = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * @param mixed $creationDate
     */
    public function setCreationDate($creationDate)
    {
        $this->creationDate = $creationDate;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @param mixed $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getVisitDate()
    {
        return $this->visitDate;
    }

    /**
     * @param mixed $visitDate
     */
    public function setVisitDate($visitDate)
    {
        $this->visitDate = $visitDate;
    }

    /**
     * @return Collection|Visitor[]
     */
    public function getVisitors()
    {
        return $this->visitors;
    }

    /**
     * @param mixed $visitors
     */
    public function setVisitors($visitors)
    {
        $this->visitors = $visitors;
    }



    public function addVisitor(Visitor $visitor): self
    {
        if (!$this->visitors->contains($visitor)) {
            $this->visitors[] = $visitor;
        }

        return $this;
    }

    public function removeVisitor(Visitor $visitor): self
    {
        if ($this->visitors->contains($visitor)) {
            $this->visitors->removeElement($visitor);
        }

        return $this;
    }

    /**
     * @return mixed
     */
    public function getisHalf()
    {
        return $this->isHalf;
    }

    /**
     * @param mixed $isHalf
     */
    public function setIsHalf($isHalf)
    {
        $this->isHalf = $isHalf;
    }

    /**
     * @return mixed
     */
    public function getisPayed()
    {
        return $this->isPayed;
    }

    /**
     * @param mixed $isPayed
     */
    public function setIsPayed($isPayed)
    {
        $this->isPayed = $isPayed;
    }




}
