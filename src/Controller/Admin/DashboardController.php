<?php

namespace App\Controller\Admin;

use App\Entity\Allergy;
use App\Entity\Category;
use App\Entity\Dish;
use App\Entity\Formula;
use App\Entity\Hourly;
use App\Entity\Menu;
use App\Entity\Reservation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
         return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('JdcRestaurant - Administartion')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
         yield MenuItem::linkToCrud('Horaires', 'fas fa-calendar-day', Hourly::class);
         yield MenuItem::linkToCrud('Formule', 'fa-solid fa-wine-glass', Formula::class);
         yield MenuItem::linkToCrud('Menu', 'fa-solid fa-pizza-slice', Menu::class);
         yield MenuItem::linkToCrud('Categorie', 'fa-solid fa-folder-tree', Category::class);
         yield MenuItem::linkToCrud('Plat', 'fa-solid fa-burger', Dish::class);
         yield MenuItem::linkToCrud('Allergie', 'fa-solid fa-seedling', Allergy::class);
         yield MenuItem::linkToCrud('Reservation', 'fa-regular fa-calendar-check', Reservation::class);
    }
}
