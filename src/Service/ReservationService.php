<?php

namespace App\Service;


use App\Entity\Reservation;

class ReservationService
{
    private $em;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getReservationTotal(\App\Entity\Reservation $reservation)
    {
        $total = 0;
        foreach ($reservation->getVisitors() as $visitor) {
            $tarif = $this->em->getRepository(\App\Entity\Tarif::class)->find($visitor->getTarif());
            $total += $tarif->getPrice();
        }
        return $total;
    }

    public function sendMail(Reservation $reservation)
    {
        mail($reservation->getEmail(), 'Récapitulatif de votre commande', "Merci pour votre commande d'un montant de " . $this->getReservationTotal($reservation) . "€");
    }

}
