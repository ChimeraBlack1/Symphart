<?php

namespace App\Controller;

use App\Entity\Sport;
use App\Form\SportMeetupType;
use App\Entity\Position;
use App\Entity\PlayerList;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Doctrine\ORM\EntityRepository;

class MeetupController extends AbstractController
{
    /**
     * @Route("/meetup", name="meetup")
     */
    public function index(Request $request)
    {
        $meetup = new Sport();
        $form = $this->createForm(SportMeetupType::class, $meetup);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ... save the meetup, redirect etc.
        }

        return $this->render('meetup/index.html.twig', [
            'controller_name' => 'MeetupController',
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/newsport", name="new_sport")
    * @Method({"GET", "POST"})
    */
    public function newSport(Request $request) {
        $sport = new Sport();

        $form = $this->createFormBuilder($sport)
        ->add('sport', TextType::class, [
            'attr'=> [
                'class' => 'form-control'
            ]
        ])
        ->add('save', SubmitType::class, [
            'label' => 'create',
        ])
        ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $mgr = $this->getDoctrine()->getManager();
            $mgr->persist($sport);
            $mgr->flush();
        }

        return $this->render('meetup/sports.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/newpos", name="new_pos")
     */
    public function newPos(Request $request){
        $sports = $this->getDoctrine()->getRepository('App:Sport')->findAll();

        $pos = new Position();

        $form = $this->createFormBuilder($pos)
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.sport', 'ASC');
                },
                'choice_label' => 'sport',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Position'
            ])
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $mgr = $this->getDoctrine()->getManager();
            $mgr->persist($pos);
            $mgr->flush();
        }

        return $this->render('meetup/pos.html.twig', [
            'sports' => $sports,
            'form' => $form->createView(),
        ]);
    }

    /**
    * @Route("/newpos2", name="new_pos2")
    */
    public function newPos2(Request $request){
        $sports = $this->getDoctrine()->getRepository('App:Sport')->findAll();

        $pos = new PlayerList();

        $form = $this->createFormBuilder($pos)
            ->add('name', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('sport', EntityType::class, [
                'class' => Sport::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.sport', 'ASC');
                },
                'choice_label' => 'sport',
            ])
            ->add('position', EntityType::class, [
                'class' => Position::class,
                'query_builder' => function(EntityRepository $er) {
                    return $er->createQueryBuilder('p')
                        ->orderBy('p.name', 'ASC');
                },
                'choice_label' => 'name',
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Create Position'
            ])
            ->getForm();
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $mgr = $this->getDoctrine()->getManager();
            $mgr->persist($pos);
            $mgr->flush();
        }

        return $this->render('meetup/pos.html.twig', [
            'sports' => $sports,
            'form' => $form->createView(),
        ]);
    }

}

// $form = $this->createForm(SportMeetupType::class, $sport);
// $form->handleRequest($request);

// if ($form->isSubmitted() && $form->isValid())  {
//     $mgr = $this->getDoctrine()->getManager();
//     $mgr->persist($sport);
//     $mgr->flush($sport);
// }

// return $this->render('meetup/sports.html.twig', [
//     'form' => $form->createView(),
// ]);
