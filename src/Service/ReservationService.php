<?php

namespace App\Service;


use App\Entity\Reservation;
use Swift_Attachment;
use Twig\Environment;

class ReservationService
{
    private $em;
    private $mailer;
    private $twig;

    public function __construct(\Doctrine\ORM\EntityManagerInterface $em, \Swift_Mailer $mailer, Environment $twig)
    {
        $this->em = $em;
        $this->mailer = $mailer;
        $this->twig = $twig;
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
        $message = (new \Swift_Message('Votre réservation ' . $reservation->getCode()))
            ->setFrom($reservation->getEmail())
            ->setTo($reservation->getEmail())
            ->setBody(
                $this->twig->render(
                    'emails/confirm-reservation.html.twig', array('reservation' => $reservation, 'total' => $this->getReservationTotal($reservation))
                ),
                'text/html'
            );

        return $this->mailer->send($message);

    }

}
