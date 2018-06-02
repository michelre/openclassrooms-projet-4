<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Visitor;
use App\Form\VisitorType;


class VisitorController extends Controller
{
    /**
     * @Route("/visitor", name="visitor")
     */
    public function index()
    {
        $visitor = new Visitor();
        $form = $this->createForm(VisitorType::class, $visitor);
        return $this->render('visitor/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
