<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Visitor;
use App\Form\VisitorType;
use App\Entity\Billet;
use Monolog\Logger;



class VisitorController extends Controller
{
    /**
     * @Route("/visitor", name="visitor")
     */
    public function index(request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $visitor = new Visitor();





        $form = $this->createForm(VisitorType::class, $visitor);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($visitor);

            $em->flush();


            return $this->redirectToRoute("billet", array('visitorId' => $visitor->getId()));
        }

        return $this->render('visitor/index.html.twig', [
            'form' => $form->createView()
        ]);


    }

}
