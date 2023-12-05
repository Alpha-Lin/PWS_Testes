<?php

namespace App\Controller;

use App\Entity\Teste;
use App\Form\TesteType;
use App\Repository\TesteRepository;
use App\Scripts\ImageUploader as ScriptsImageUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Attribute\MapEntity;

#[Route('/teste')]
class TesteController extends AbstractController
{
    #[Route('/', name: 'app_teste_index', methods: ['GET'])]
    public function index(Request $request, TesteRepository $testeRepository): Response
    {   
        $name = null;
        $id = null;

        if ($request->query->get('name')) {
            $name = $request->query->get('name');
        }

        if ($request->query->get('mineOnly') === 'on') {
            $id = $this->getuser()->getId();
        }

        return $this->render('teste/index.html.twig', [
            'testes' => $testeRepository->filterTeste($name, $id),
        ]);
    }

    // https://symfony.com/doc/current/form/form_collections.html
    #[Route('/new', name: 'app_teste_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ScriptsImageUploader $uploader): Response
    {
        $teste = new Teste();

        $form = $this->createForm(TesteType::class, $teste);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $teste->setUser($this->getUser());

            // Vérifie si des images sont envoyées pour les critères
            $indexCriteres = 0;

            foreach ($teste->getCriteres() as $critere) {
                if ($form->get('criteres')->get($indexCriteres)->get('interpretationMaxImage')->getData() != null)
                    $critere->setInterpretationMaxImage($uploader->upload($form->get('criteres')->get(0)->get('interpretationMaxImage')->getData()));
                if ($form->get('criteres')->get($indexCriteres)->get('interpretationMinImage')->getData() != null)
                    $critere->setInterpretationMinImage($uploader->upload($form->get('criteres')->get(0)->get('interpretationMinImage')->getData()));

                $indexCriteres++;
            }

            // Vérifie qu'une image est envoyée pour le teste
            if ($form->get('imageTeste')->getData() != null)
                $teste->setImageTeste($uploader->upload($form->get('imageTeste')->getData()));

            $entityManager->persist($teste);
            $entityManager->flush();

            return $this->redirectToRoute('app_teste_edit', ['id' => $teste->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('teste/new.html.twig', [
            'teste' => $teste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_teste_show', methods: ['GET'])]
    public function show(Teste $teste): Response
    {
        return $this->render('teste/show.html.twig', [
            'teste' => $teste,
        ]);
    }
    
    #[Route('/{id}/edit', name: 'app_teste_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Teste $teste, EntityManagerInterface $entityManager, ScriptsImageUploader $uploader): Response
    {
        
        if ($this->getUser() !== $teste->getuser() || $this->isGranted('ROLE_EDITEUR')) {
            return $this->redirectToRoute('app_teste_index', [], Response::HTTP_SEE_OTHER);
        }

        $form = $this->createForm(TesteType::class, $teste);
            
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Vérifie si des images sont envoyées pour les critères
            $indexCriteres = 0;

            foreach ($teste->getCriteres() as $critere) {
                if ($form->get('criteres')->get($indexCriteres)->get('interpretationMaxImage')->getData() != null)
                    $critere->setInterpretationMaxImage($uploader->upload($form->get('criteres')->get(0)->get('interpretationMaxImage')->getData()));
                if ($form->get('criteres')->get($indexCriteres)->get('interpretationMinImage')->getData() != null)
                    $critere->setInterpretationMinImage($uploader->upload($form->get('criteres')->get(0)->get('interpretationMinImage')->getData()));

                $indexCriteres++;
            }

            // Vérifie qu'une image est envoyée
            if ($form->get('imageTeste')->getData() != null)
                $teste->setImageTeste($uploader->upload($form->get('imageTeste')->getData()));

            $entityManager->flush();

            return $this->redirectToRoute('app_teste_edit', ['id' => $teste->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->render('teste/edit.html.twig', [
            'teste' => $teste,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_teste_delete', methods: ['POST'])]
    public function delete(Request $request, Teste $teste, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $teste->getId(), $request->request->get('_token'))) {
            $entityManager->remove($teste);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_teste_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/results', name: 'app_teste_results', methods: ['GET'])]
    public function results(Request $request, Teste $teste): Response
    {
        
        return $this->render('teste/results.html.twig');
    }
}
