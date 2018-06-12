<?php

namespace App\Controller;

use Doctrine\ORM\Mapping\Id;
use phpDocumentor\Reflection\Types\Integer;
use PhpParser\Node\Expr\Cast\Int_;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Billet;
use App\Form\BilletType;
use App\Form\VisitorType;
USE App\Entity\Visitor;
use Monolog\Logger;


class BilletController extends Controller
{
    /**
     * @Route("/billet/{visitorId}", name="billet")
     */
    public function index(request $request, $visitorId)
    {


        $em = $this->getDoctrine()->getManager();

        $visitor = $this->getDoctrine()->getRepository(Visitor::class);




        $billet = new Billet();


        $billet->setVisitor( $visitor->find($visitorId));


        $form = $this->createForm(BilletType::class, $billet);



        if ($request->isMethod('POST') && $form->handleRequest($request)->isValid()){
            $em->persist($billet);
            $em->flush();



        }

        return $this->render('billet/index.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
