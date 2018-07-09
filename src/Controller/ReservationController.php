<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ReservationController extends Controller
{
    /**
     * @Route("/reservation", name="reservation")
     */
    public function index()
    {
        return $this->render('reservation/index.html.twig', [
            'controller_name' => 'ReservationController',
        ]);
    }

    /**
     * @Route("/reservation", name="createReservation")
     * @Method({"POST"})
     */

    public function validateForm (request $request){
        var_dump($request->request->all());
        return new Response();

    }
}
