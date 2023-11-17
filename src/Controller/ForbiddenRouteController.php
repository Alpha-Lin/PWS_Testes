<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ForbiddenRouteController extends AbstractController
{
    #[Route("/access-denied", name:"app_access_denied")]
    public function accessDenied()
    {
        if ( $this->getUser() ) {
            return $this->redirectToRoute('dashboard_index');
        }

        return $this->redirectToRoute('app_login');
    }
}
