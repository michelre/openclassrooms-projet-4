<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use App\Entity\Reservation;
use JMS\Serializer\SerializerBuilder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ReservationController extends Controller
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index()
    {
        return $this->render('reservation/index.html.twig', [

        ]);


    }

    /**
     * @Route("/api/reservation", name="validateVisitor")
     * @Method({"POST"})
     */
    public function validateForm(request $request)
    {

        $em = $this->getDoctrine()->getManager();

        $formFields = $request->getContent();
        $serializer = SerializerBuilder::create()->build();
        $visitors = $serializer->deserialize($formFields, 'array<App\Entity\Visitor>', 'json');

        $reservation = new Reservation();
        $reservation->setCode('ABCD');
        $reservation->setCreationDate(new \DateTime());

        foreach ($visitors as $visitor) {
            $reservation->addVisitor($visitor);
        }

        $em->persist($reservation);
        $em->flush();

        return new Response(json_encode(array("status" => "OK", "reservation_code" => $reservation->getCode())));
    }
}