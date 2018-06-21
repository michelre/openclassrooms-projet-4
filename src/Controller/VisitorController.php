<?php

namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Visitor;
use App\Form\VisitorType;
use App\Entity\Billet;
use Symfony\Component\HttpFoundation\Response;


class VisitorController extends Controller
{
    /**
     * @Route("/visitor", name="visitor")
     */
    public function index()
    {



        return $this->render('visitor/index.html.twig', [

        ]);


    }

    /**
     * @Route("/visitor/add", name="validateVisitor")
     * @Method({"POST"})
     */

    public function validateForm (request $request){
        var_dump($request->request->all());
        return new Response();

    }



}
