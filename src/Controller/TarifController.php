<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Tarif;
use App\Form\TarifType;
Use App\Entity\Billet;

class TarifController extends Controller
{
    /**
     * @Route("/tarif/{billetId}", name="tarif")
     */
    public function index(request $request, $billetId)
    {


        $em = $this->getDoctrine()->getManager();

        $billet = $this->getDoctrine()->getRepository(Billet::class);


        $tarif = new Tarif();


        $tarif->setBillet($billet->find($billetId));


        $form = $this->createForm(TarifType::class, $tarif);


        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()) {
            $em->persist($tarif);
            $em->flush();

            return $this->redirectToRoute("reservation", array('tarifId' => $tarif->getId()));
        }

        return $this->render('tarif/index.html.twig', [
            'form' => $form->createView()
        ]);

    }
}