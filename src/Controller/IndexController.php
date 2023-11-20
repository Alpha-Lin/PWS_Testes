<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    #[Route('/dashboard', name: 'user_index')]
    public function index(): Response
    {
        return $this->render('home/dashboard.html.twig');
    }


    #[Route('/', name: 'public_index')]
    public function index_unlogged(): Response
    {
        return $this->render('home/index.html.twig');
    }
}
