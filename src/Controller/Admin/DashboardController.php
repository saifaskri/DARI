<?php

namespace App\Controller\Admin;

use App\Entity\AccomodationType;
use App\Entity\Advertisment;
use App\Entity\RentPeriodation;
use App\Entity\States;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    ){

    }



    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator->setController(UserCrudController::class)->generateUrl();
        return $this->redirect($url);

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('DARI');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Dynamic Fields');

        yield MenuItem::subMenu('Users','fas fa-user')->setSubItems([
            MenuItem::linkToCrud('Users', 'fas fa-eye', User::class)
        ]);

        yield MenuItem::subMenu('Advertisement','fa-solid fa-list')->setSubItems([
            MenuItem::linkToCrud('Advertisement', 'fas fa-plus',Advertisment::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Advertisement', 'fas fa-eye', Advertisment::class)
        ]);

        yield MenuItem::section('Fixed Fields');

        yield MenuItem::subMenu('States','fa-solid fa-flag')->setSubItems([
            MenuItem::linkToCrud('States', 'fas fa-plus', States::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('States', 'fas fa-eye', States::class)
        ]);

        yield MenuItem::subMenu('Accommodation','fa-solid fa-building')->setSubItems([
            MenuItem::linkToCrud('AccommodationType', 'fas fa-plus', AccomodationType::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('AccommodationType', 'fas fa-eye', AccomodationType::class)
        ]);

        yield MenuItem::subMenu('Type Of Rent','fa-solid fa-clock-rotate-left')->setSubItems([
            MenuItem::linkToCrud('Type Of Rent', 'fas fa-plus', RentPeriodation::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Type Of Rent', 'fas fa-eye', RentPeriodation::class)
        ]);
    }
}
