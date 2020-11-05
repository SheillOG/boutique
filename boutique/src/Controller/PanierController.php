<?php

namespace App\Controller;

use App\Entity\Contenir;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Repository\ContenirRepository;
use App\Repository\PanierRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PanierController extends AbstractController
{


    /**
     * @Route("/panier", name="panier")
     */
    public function index(EntityManagerInterface $manager): Response
    {
        $lePanier = $manager->getRepository(Panier::class)->findAll();

        if(count($lePanier) == 0){
            $lePanier = new Panier();


            $lePanier->setDateCreation(new dateTime());
            $lePanier->setMontantTotal(0);
            $manager->persist($lePanier);
            $manager->flush();

            $montant_total = 0;
            $lesProduits = array();
    } else {
            $lePanier = $lePanier[0];

            $dateCreation = $lePanier->getDateCreation();
            $montant_total = $lePanier->getMontantTotal();
            $lesProduits = $manager->getRepository(Contenir::class)->findAll();

        }


        return $this->render('panier/index.html.twig', [
            'controller_name' => 'PanierController',
            'panier' => $lePanier,
            'montant_total' => $montant_total,
            'les_produits' => $lesProduits
        ]);
    }

    /**
     * @Route("/panier/add/{id}", name="panier_add")
     */


    public function add(EntityManagerInterface $manager, Produit $produit, SessionInterface $session): RedirectResponse
    {

        $produits = $session->get('les_produits', array());

        if (!isset($produits[$produit->getId()])) {

            $produits[$produit->getId()] ["objProduit"] = $produit;
            $produits[$produit->getId()] ["quantite"] = 1;
            $produits[$produit->getTarif()] ["tarif"];
        }
        else {
            $produits[ $produit->getId()] ["quantite"]++;
        }

        $session->set('les_produits', $produits);
        $session->set('total_produits', $session->get('total_produits') + 1);







        return $this->redirectToRoute('produit_index');
    }

}
