<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\TesteRepository;

class HomeController extends AbstractController
{
    #[Route('/', name: 'public_index')]
    public function index(TesteRepository $testeRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'populaire' => $testeRepository->findPopularTests(6, 6, 1),
            'dernier' =>  $testeRepository->findLastCreatedTests(6)
        ]);
    }

    #[Route('/dashboard', name:'user_index')]
    public function user_index(TesteRepository $testeRepository): Response
    {

        return $this->render('home/dashboard.html.twig', [
            'populaire' => $testeRepository->findPopularTests(6, 6, 1),
            'dernier' =>  $testeRepository->findLastCreatedTests(6)
        ]);
    }


}
