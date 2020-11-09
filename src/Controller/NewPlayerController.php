<?php

namespace App\Controller;

use App\Entity\PlayerList;
use App\Form\NewPlayerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewPlayerController extends AbstractController
{
    /**
     * @Route("/new/player", name="new_player")
     */
    public function index()
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
