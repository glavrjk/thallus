<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('', name: 'app_')]
class DefaultController extends AbstractController {

    /**
     * Dashboard Page
     * @return Response
     */
    #[Route('/', name: 'index')]
    public function index(): Response {
        return $this->redirectToRoute('app_dashboard', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * Dashboard Page
     * @return Response
     */
    #[Route('/dashboard', name: 'dashboard')]
    #[IsGranted('ROLE_USER')]
    public function dashboard(): Response {
        return $this->render('default/dashboard.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }
}
