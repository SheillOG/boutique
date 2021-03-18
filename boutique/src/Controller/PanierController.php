<?php

namespace App\Controller;

use App\Entity\Contenir;
use App\Entity\Panier;
use App\Entity\Produit;
use App\Managers\PlaceholderManager;
use App\Repository\ContenirRepository;
use App\Repository\PanierRepository;
use App\Repository\ProduitRepository;
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
    public function index(EntityManagerInterface $manager, ContenirRepository $contenirRepository): Response
    {
        $lePanier = $manager->getRepository(Panier::class)->findAll();

        if (count($lePanier) == 0) {
            $lePanier = new Panier();
            $dateCreation = "2020/11/01";

            $lePanier->setDateCreation(date('d/m/y'));
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

        return $this->render('panier/index.html.twig', array_merge(PlaceholderManager::load(),[
            'contenirs' => $contenirRepository->findAll(),
            'controller_name' => 'PanierController',
            'panier' => $lePanier,
            'date_creation' => $dateCreation,
            'montant_total' => $montant_total,
            'les_produits' => $lesProduits,
        ]));
    }

    /**
     * @Route ("/add/{id}", name="panier_add")
     */

    public function add(EntityManagerInterface $manager, Produit $produit, SessionInterface $session, PanierRepository $panierRepository): RedirectResponse
    {
        //$session->clear();
        $contenir = new Contenir();
        $produits = $session->get('les_produits', array());

        $lesPaniers = $panierRepository->findAll();
        if (count($lesPaniers) != 0) {
            $panier = $lesPaniers[0];
        } else {
            $panier = new Panier();
            $panier->setDateCreation(new \DateTime(date("Y/m/d")));
            $panier->setMontantTotal(0);
            $manager->persist($panier);
            $manager->flush();
        }

        if (!isset($produits[$produit->getId()])) {
            $produits[$produit->getId()]["objProduit"] = $produit;
            $produits[$produit->getId()]["quantite"] = 1;

            $contenir->setIdProduit($produit);
            $contenir->setIdPanier($panier);
            $contenir->setQuantite(1);
            $manager->persist($contenir);


        } else {
            $produits[$produit->getId()]["quantite"]++;
            $contenir = $manager->getRepository(Contenir::class)->findAll();
            foreach ($contenir as $key => $unProduit) {
                if ($unProduit->getIdProduit()->getId() == $produit->getId()) {
                    $contenir[$key]->setQuantite($contenir[$key]->getQuantite() + 1);
                }
            }
            $manager->flush();
        }
        $panier->setMontantTotal($panier->getMontantTotal() + $produit->getTarif());
        $manager->flush();

        $session->set('les_produits', $produits);

        return $this->redirectToRoute('produit_index');
    }

    /**
     * @Route ("/remove", name="panier_remove")
     */

    public function delete(SessionInterface $session, EntityManagerInterface $manager)
    {

        $lesPaniers = $manager->getRepository(Panier::class)->findAll();
        $produits = $session->get('les_produits', array());
        if (count($lesPaniers) == 0) {
            //je créé le panier
            $panier = new Panier();
            $panier->setMontantTotal(0);
            $panier->setDateCreation(date("Y/m/d"));

            $manager->persist($panier);
            $manager->flush();
        } else {
            //je récupère l'id du premier panier
            $panier = $lesPaniers[0];
        }
        $session->set('panier', $panier);
        $session->set('total_produit', 0);


        $panier = $manager->getRepository(Panier::class)->find($session->get('panier'));
        $panier->setMontantTotal(0);
        $contenir = $manager->getRepository(Contenir::class);//->find($session->get('panier'));
        $contenir->deleteTuples($session);
        $session->remove('les_produits', $produits);
        $contenir->clear();
        $manager->flush();
        return $this->redirectToRoute('panier');

    }

}


