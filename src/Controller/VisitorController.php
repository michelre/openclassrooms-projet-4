<?php

namespace App\Controller;

use App\Entity\Visitor;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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

    public function validateForm(request $request)
    {
        $formFields = $request->request->all();
        foreach($formFields['visitor'] as $visitorData){
            $visitor = new Visitor();
            $visitor
                ->setFirstName($visitorData['first_name'])
                ->setLastName($visitorData['last_name']);
            var_dump($visitor);
        }


        /*foreach (array_keys($formFields) as $key) {
            //print_r($formFields[$key]);
            foreach ($formFields[$key] as $fieldValue){
                var_dump($fieldValue);
            }
            //var_dump($key, $formFields[$key]);
        }*/



        //foreach (array_keys($formFields) as $key) {


        //var_dump($formFields[$key], $key);
        //}
        return new Response();

    }


}
