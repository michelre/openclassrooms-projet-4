<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Entity\Tarif;
use App\Entity\Visitor;
use App\Service\ReservationService;
use Doctrine\DBAL\Types\Type;
use JMS\Serializer\SerializerBuilder;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use ShortCode\Random;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ReservationController extends Controller
{
    private $reservationService;

    public function __construct(ReservationService $reservationService)
    {
        $this->reservationService = $reservationService;
    }

    /**
     * @Route("/reservation", name="reservation")
     */
    public function index()
    {
        return $this->render('reservation/index.html.twig', [

        ]);
    }

    /**
     * @Route("/api/reservation/available", name="reservationAvailable")
     */
    public function isReservationAvailable(request $request)
    {
        $date = $request->query->get('date');
        $startDate = \DateTime::createFromFormat('d/m/Y', $date)->setTime(0, 0, 0);
        $endDate = \DateTime::createFromFormat('d/m/Y', $date)->setTime(23, 59, 59);
        $em = $this->getDoctrine()->getManager();
        $qb = $em
            ->getRepository('App:Reservation')
            ->createQueryBuilder('nbVisitorsByDate');

        $reservations = $qb->select('r')
            ->from('App:Reservation', 'r')
            ->where($qb->expr()->between('r.visitDate', ':startDate', ':endDate'))
            ->setParameter('startDate', $startDate, Type::DATETIME)
            ->setParameter('endDate', $endDate, Type::DATETIME)
            ->getQuery()
            ->execute();
        $nbVisitors = $this->reservationService->getNbVisitors($reservations) + $request->query->get('nbPlaces');
        return new Response(json_encode(array("isDateAvailable" => $nbVisitors < 1000)));
    }

    /**
     * @Route("/api/reservation", name="validateVisitor")
     * @Method({"POST"})
     */
    public function validateForm(request $request)
    {

        $em = $this->getDoctrine()->getManager();

        //$content = json_decode($request->getContent(), true);

        $serializer = SerializerBuilder::create()->build();
        /** @var Reservation $reservation */
        $reservation = $serializer->deserialize($request->getContent(), 'App\Entity\Reservation', 'json');
        $reservation->setCode(Random::get());
        $reservation->setCreationDate(new \DateTime());
        $reservation->setIsPayed(false);

        foreach ($reservation->getVisitors() as $visitor) {
            /** @var Visitor $visitor */
            $tarif = $visitor->getTarif();
            $visitor->setTarif($em->getRepository(Tarif::class)->find($tarif));
        }
        $em->persist($reservation);
        $em->flush();

        return new Response(json_encode(array(
            "total" => $this->reservationService->getReservationTotal($reservation),
            "reservation" => json_decode($serializer->serialize($reservation, 'json'), true),
            "status" => "OK"
        )));
    }

    /**
     * @Route("/api/reservation/{code}/pay", name="payReservation")
     * @Method({"PUT"})
     * @param $code
     * @return Response
     */
    public function payReservation($code)
    {

        $em = $this->getDoctrine()->getManager();

        /** @var Reservation $reservation */
        $reservation = $em->getRepository(Reservation::class)->findOneBy(array('code' => $code));
        $reservation->setIsPayed(true);
        $this->reservationService->sendMail($reservation);
        $em->persist($reservation);
        $em->flush();

        return new Response(json_encode(array("status" => "OK")));
    }
}
