<?php

namespace App\Controller;

use App\Managers\PlaceholderManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaimentController extends AbstractController
{
    /**
     * @Route("/paiment", name="paiment")
     */
    public function index(): Response
    {
        return $this->render('paiment/index.html.twig', array_merge(PlaceholderManager::load(),[
            'controller_name' => 'PaimentController',
        ]));
    }

    /**
     * @Route("/paimentsucess", name="paiment_succefull")
     */
    public function return(){
        return $this->redirectToRoute('accueil');
    }
}
