<?php

namespace App\Controller;

use App\Entity\CritereSolution;
use App\Form\CritereSolutionType;
use App\Repository\CritereSolutionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/critere/solution')]
class CritereSolutionController extends AbstractController
{
    #[Route('/', name: 'app_critere_solution_index', methods: ['GET'])]
    public function index(CritereSolutionRepository $critereSolutionRepository): Response
    {
        return $this->render('critere_solution/index.html.twig', [
            'critere_solutions' => $critereSolutionRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_critere_solution_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $critereSolution = new CritereSolution();
        $form = $this->createForm(CritereSolutionType::class, $critereSolution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($critereSolution);
            $entityManager->flush();

            return $this->redirectToRoute('app_critere_solution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('critere_solution/new.html.twig', [
            'critere_solution' => $critereSolution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_critere_solution_show', methods: ['GET'])]
    public function show(CritereSolution $critereSolution): Response
    {
        return $this->render('critere_solution/show.html.twig', [
            'critere_solution' => $critereSolution,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_critere_solution_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CritereSolution $critereSolution, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CritereSolutionType::class, $critereSolution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_critere_solution_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('critere_solution/edit.html.twig', [
            'critere_solution' => $critereSolution,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_critere_solution_delete', methods: ['POST'])]
    public function delete(Request $request, CritereSolution $critereSolution, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$critereSolution->getId(), $request->request->get('_token'))) {
            $entityManager->remove($critereSolution);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_critere_solution_index', [], Response::HTTP_SEE_OTHER);
    }
}
