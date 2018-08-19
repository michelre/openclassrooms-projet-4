<?php

namespace App\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use App\Entity\Billet;
use App\Entity\Tarif;
use App\Form\TarifType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\HttpFoundation\Response;

class TarifController extends Controller
{

    /**
     * @Route("/api/tarifs", name="tarifs")
     */
    public function getTarifs()
    {
        $em = $this->getDoctrine()->getManager();
        $tarifs = $this->getDoctrine()->getRepository(Tarif::class)->findAll();
        $serializer = SerializerBuilder::create()->build();
        return new Response($serializer->serialize($tarifs, 'json'));
    }

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
