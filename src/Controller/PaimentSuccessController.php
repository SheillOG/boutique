<?php

namespace App\Controller;

use App\Managers\PlaceholderManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PaimentSuccessController extends AbstractController
{
    /**
     * @Route("/paiment/success", name="paiment_success")
     */
    public function index(): Response
    {
        return $this->render('paiment_success/index.html.twig', array_merge( PlaceholderManager::load(),[
            'controller_name' => 'PaimentSuccessController',
        ]));
    }
}
