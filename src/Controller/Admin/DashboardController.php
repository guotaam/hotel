<?php

namespace App\Controller\Admin;

use App\Entity\Membre;
use App\Entity\Chambre;
use App\Entity\Commande;
use App\Entity\Slider;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

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
            ->setTitle('HotelSabaa');
    }

    public function configureMenuItems(): iterable
    {
        return[
            MenuItem::linkToRoute("Retour à l'accueil", 'fas fa-arrow-left', 'app_main'),
            MenuItem::linkToDashboard('Dashboard', 'fa fa-home'),
            MenuItem::section('Gestion des données'),
           MenuItem::linkToCrud('Commandes', 'fas fa-cash-register', Commande::class),
           MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', Membre::class),
            MenuItem::linkToCrud('Chambre', 'fas fa-user', Chambre::class),
            MenuItem::linkToCrud('Slider', 'fas fa-user', Slider::class),
        ];            
    }
}
