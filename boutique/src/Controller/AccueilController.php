<?php

namespace App\Controller;

use App\Repository\ProduitRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Managers\PlaceholderManager;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function index(ProduitRepository $produitRepository): Response
    {

        return $this->render('accueil/index.html.twig', array_merge(
            PlaceholderManager::load(),
            ['controller_name' => 'AccueilController', "produits" => $produitRepository->findAll()]
        ));
    }
}
