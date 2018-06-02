<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TarifController extends Controller
{
    /**
     * @Route("/tarif", name="tarif")
     */
    public function index()
    {
        return $this->render('tarif/index.html.twig', [
            'controller_name' => 'TarifController',
        ]);
    }
}
