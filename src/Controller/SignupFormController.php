<?php

namespace App\Controller;

use App\Entity\ListOfPlayers;
use App\Entity\Position;
use App\Form\SignupFormType;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class SignupFormController extends AbstractController
{
    /**
     * @Route("/signup/form", name="signup_form")
     */
    public function index(Request $request)
    {
        // findBySportID
        dump($request->attributes);
        $repository = $this->getDoctrine()->getRepository(Position::class);
        $positions = $repository->findBySportID(2);

        $player = new ListOfPlayers();
        $form = $this->createForm(SignupFormType::class, $player);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $unmappedField = $form['sport']->getData();
            // dump($unmappedField->getId());
            // die();
            $mgr = $this->getDoctrine()->getManager();
            $mgr->persist($player);
            $mgr->flush();
            // ... save the meetup, redirect etc.
        }

        return $this->render('signup_form/index.html.twig', [
            'controller_name' => 'SignupFormController',
            'form' => $form->createView(),
            'positions' => $positions,
        ]);
    }

    /**
    * @Route("/ajax", name="signup_ajax")
    * @Method({"GET"})
    */
    public function ajax(Request $request) {
        $positions = $this->getDoctrine() 
            ->getRepository('App:Position')
            ->findAll();

        if ($request->isXmlHttpRequest() || $request->query->get('showJson') == 1) {  
            $jsonData = array();  
            $idx = 0;  
            foreach($position as $positions) {  
                $temp = array(
                    'name' => $positions->getName(),
                );   
                $jsonData[$idx++] = $temp;  
            } 
            return new JsonResponse($jsonData); 
        } 
        else { 
            return $this->render('signup_form/index.html.twig'); 
        }        
    }
}
