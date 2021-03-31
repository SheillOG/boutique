<?php

namespace App\Controller\Admin;

use App\Entity\Categorie;
use App\Entity\Produit;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */

    public function index(): Response
    {
        return parent::index();
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Panel Admin');
    }

    public function configureMenuItems(): iterable
    {
/*        yield MenuItem::linktoDashboard('Accueil', 'fa fa-home', User::class);*/
        yield MenuItem::section('Profil');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-user', User::class);
        yield MenuItem::section('Gestion Produit');
        yield MenuItem::linkToCrud('Categorie', 'fas fa-book', Categorie::class);
        yield MenuItem::linkToCrud('Produit', 'fas fa-shopping-bag', Produit::class);
    }
}
