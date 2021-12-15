<?php

namespace App\Controller;

use App\Entity\Person;
use App\Form\PersonType;
use App\Repository\PersonRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/personas')]
class PersonController extends AbstractController {

    #[Route('/', name: 'person_index', methods: ['GET'])]
    public function index(Request $request, PersonRepository $personRepository): Response {
        return $this->render('person/' . ($request->query->get('ajax') ? '_list' : 'index') . '.html.twig', [
            'people' => $personRepository->findAll(),
        ]);
    }

    #[Route('/nueva', name: 'person_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response {
        $person = new Person();
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($person);
            $entityManager->flush();
        }

        return $this->render('person/_form.html.twig', [
            'person' => $person,
            'form' => $form->createView()
        ], new Response(
            null,
            $form->isSubmitted() && !$form->isValid() ? 422 : 200,
        ));
    }

    // #[Route('/{id}', name: 'person_show', methods: ['GET'])]
    // public function show(Person $person): Response
    // {
    //     return $this->render('person/show.html.twig', [
    //         'person' => $person,
    //     ]);
    // }

    #[Route('/{id}/modificar', name: 'person_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Person $person, EntityManagerInterface $entityManager): Response {
        $form = $this->createForm(PersonType::class, $person);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
        }

        return $this->render('person/_form.html.twig', [
            'person' => $person,
            'form' => $form->createView()
        ], new Response(
            null,
            $form->isSubmitted() && !$form->isValid() ? 422 : 200,
        ));
    }

    #[Route('/{id}/eliminar', name: 'person_delete', methods: ['POST'])]
    public function delete(Request $request, Person $person, EntityManagerInterface $entityManager): Response {
        if ($this->isCsrfTokenValid('delete' . $person->getId(), $request->request->get('_token'))) {
            $entityManager->remove($person);
            $entityManager->flush();
        }

        return $this->redirectToRoute('person_index', [], Response::HTTP_SEE_OTHER);
    }
}
