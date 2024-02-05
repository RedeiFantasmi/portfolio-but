<?php

namespace App\Controller;

use App\Entity\Career;
use App\Entity\Project;
use App\Entity\Skill;
use App\Entity\SkillType;
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
        return $this->render('dashboard/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Portfolio But');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::section('Administration');
        yield MenuItem::linkToCrud('Parcours', 'fas fa-list', Career::class);
        yield MenuItem::linkToCrud('Projets', 'fas fa-list', Project::class);
        yield MenuItem::linkToCrud('Compétences', 'fas fa-list', Skill::class);
        yield MenuItem::linkToCrud('Types de compétences', 'fas fa-list', SkillType::class);

        yield MenuItem::section('Divers');
        yield MenuItem::linkToUrl('Revenir au portfolio', 'fas fa-arrow-up-right-from-square', $this->generateUrl('app_home'));
        yield MenuItem::linkToLogout('Se déconnecter', 'fa fa-sign-out');
    }
}
