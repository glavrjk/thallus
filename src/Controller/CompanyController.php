<?php

namespace App\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/empresas')]
class CompanyController extends AbstractController {

    #[Route('/', name: 'company_index', methods: ['GET'])]
    public function index(Request $request, CompanyRepository $companyRepository): Response {
        return $this->render('company/' . ($request->query->get('ajax') ? '_list' : 'index') . '.html.twig', [
            'companies' => $companyRepository->findAll(),
        ]);
    }

    #[Route('/nueva', name: 'company_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response {
        $company = new Company();
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($company);
            $entityManager->flush();
        }

        return $this->render('company/_form.html.twig', [
            'company' => $company,
            'form' => $form->createView()
        ], new Response(
            null,
            $form->isSubmitted() && !$form->isValid() ? 422 : 200,
        ));
    }

    // #[Route('/{id}', name: 'company_show', methods: ['GET'])]
    // public function show(Company $company): Response {
    //     return $this->render('company/show.html.twig', [
    //         'company' => $company,
    //     ]);
    // }

    #[Route('/{id}/modificar', name: 'company_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Company $company, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(CompanyType::class, $company);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
        }
        return $this->render('company/_form.html.twig', [
            'company' => $company,
            'form' => $form->createView()
        ], new Response(
            null,
            $form->isSubmitted() && !$form->isValid() ? 422 : 200,
        ));
    }

    #[Route('/{id}/eliminar', name: 'company_delete', methods: ['POST'])]
    public function delete(Request $request, Company $company, EntityManagerInterface $entityManager): Response {       
        if ($this->isCsrfTokenValid('delete' . $company->getId(), $request->request->get('_token'))) {
            $entityManager->remove($company);
            $entityManager->flush();
        }
        return $this->redirectToRoute('company_index', [], Response::HTTP_SEE_OTHER);
    }
}
