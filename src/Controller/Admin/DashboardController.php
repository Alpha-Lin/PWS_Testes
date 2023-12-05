<?php

namespace App\Controller\Admin;

use App\Entity\Tentative;
use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\User;
use App\Entity\Teste;
use App\Entity\TypeTeste;
use App\Entity\Message;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('StonksQuizz');
    }

    public function configureMenuItems(): iterable
    {   
        yield MenuItem::section('Moderation');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Message', 'fas fa-envelope', Message::class);       

        yield MenuItem::section('Quizz');
        yield MenuItem::linkToCrud('Type de teste', 'fas fa-tags', TypeTeste::class);
        yield MenuItem::linkToCrud('Testes', 'fas fa-hashtag', Teste::class)->setController(TesteCrudController::class);
        yield MenuItem::linkToCrud('Tentatives', 'fas fa-list-check', Tentative::class);
        yield MenuItem::linkToCrud('Questions', 'fas fa-commenting', Question::class);
        
        yield MenuItem::section("Mon compte");
        yield MenuItem::linkToLogout('Logout', 'fa fa-sign-out');
        yield MenuItem::linkToRoute('Profile', 'fa fa-user-cog', '...', ['...' => '...']);
    }
}
