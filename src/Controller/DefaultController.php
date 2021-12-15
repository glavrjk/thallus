<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('', name: 'app_')]
class DefaultController extends AbstractController {

    /**
     * Dashboard Page
     * @return Response
     */
    #[Route('/dashboard', name: 'dashboard')]
    public function dashboard(): Response {
        return $this->render('default/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
    
}
