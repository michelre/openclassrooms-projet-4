<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class VisitorController extends Controller
{
    /**
     * @Route("/visitor", name="visitor")
     */
    public function index()
    {
        return $this->render('visitor/index.html.twig', [
            'controller_name' => 'VisitorController',
        ]);
    }
}
