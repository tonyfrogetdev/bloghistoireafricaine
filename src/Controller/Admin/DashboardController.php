<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
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
            ->setTitle('Blog Panafricain');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('The Label', 'fas fa-list', Article::class);

        yield MenuItem::subMenu('Articles', 'fas fa-newspaper')->setSubItems([
           MenuItem::linkToCrud('Tous les articles', 'fas fa-newspapper',Article::class),
           MenuItem::linkToCrud('Ajouter', 'fas fa-plus',Article::class)->setAction(Crud::PAGE_NEW),
           MenuItem::linkToCrud('Categories', 'fas fa-list',Category::class)
        ]);
    }
}
