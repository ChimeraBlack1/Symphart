<?php

namespace App\Controller;

use App\Entity\PlayerList;
use App\Form\NewPlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

class NewPlayerController extends AbstractController
{
    /**
     * @Route("/new/player", name="new_player")
     */
    public function index(Request $request)
    {
        $player = new PlayerList();
        $form = $this->createForm(NewPlayerType::class, $player);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // ... save the meetup, redirect etc.
        }

        return $this->render('new_player/index.html.twig', [
            'controller_name' => 'NewPlayerController',
            'form' => $form->createView(),
        ]);
    }
}
