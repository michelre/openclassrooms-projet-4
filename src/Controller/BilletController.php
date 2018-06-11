<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Billet;
use App\Form\BilletType;
use App\Form\VisitorType;
USE App\Entity\Visitor;

class BilletController extends Controller
{
    /**
     * @Route("/billet", name="billet")
     */
    public function index(request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Billet = new Billet();



        $form = $this->createForm(BilletType::class, $Billet);



        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($Billet);
            $em->flush();

        }

        return $this->render('billet/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
