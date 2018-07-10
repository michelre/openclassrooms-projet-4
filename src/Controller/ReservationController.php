<?php

namespace App\Controller;

use App\Entity\Billet;
use App\Entity\Tarif;
use App\Entity\Visitor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
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
     * @Route("/reservation/add", name="validateVisitor")
     * @Method({"POST"})
     */
    public function validateForm(request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $formFields = $request->request->all();
        foreach ($formFields['visitor'] as $visitorData) {
            $visitor = new Visitor();
            $visitor
                ->setLastName($visitorData['last_name'])
                ->setFirstName($visitorData['first_name'])
                ->setCountry($visitorData['country'])
                ->setBithdate($visitorData['bithdate'])
                ->setEmail($visitorData['email']);
            var_dump($visitor);
        }
        foreach ($formFields['billet'] as $billetData) {
            $billet = new Billet();
            $billet
                ->setType($billetData['type'])
                ->setVisitDate($billetData['visite_date'])
                ->setIsHalf($billetData['is_half']);
            var_dump($billet);
        }
        foreach ($formFields['tarif'] as $tarifData) {
            $tarif = new Tarif();
            $tarif
                ->setPrice($tarifData['price'])
                ->setName($tarifData['name']);
            var_dump($tarif);
        }
        $em->persist($visitor);
        $em->persist($billet);
        $em->persist($tarif);
        $em->flush();

        return new Response();
    }
}