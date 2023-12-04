<?php

namespace App\Controller;

use App\Entity\Tentative;
use App\Entity\Teste;
use App\Entity\Question;
use App\Entity\Solution;

use App\Form\TentativeType;
use App\Repository\TentativeRepository;
use App\Repository\TesteRepository;
use App\Repository\QuestionRepository;


use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/tentative')]
class TentativeController extends AbstractController
{
    #[Route('/', name: 'app_tentative_index', methods: ['GET'])]
    public function index(TentativeRepository $tentativeRepository): Response
    {
        return $this->render('tentative/index.html.twig', [
            'tentatives' => $tentativeRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_tentative_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager,TesteRepository $testeRepository, QuestionRepository $questionRepository): Response
    {
        $save = $request->query->get('testId');
        $test = $testeRepository->findById($save);
        $tentative = new Tentative();
        $tentative->setTeste($test);
        if(is_null($test)){
            $test = new Teste();
            $test->setLabel("pour les tests");
            $tentative->setTeste($test);
            $question1 = new Question();
            $question2 = new Question();

            $question1->setQuestion("Chien ou banane");
            $question2->setQuestion("Question 2");

            $solution1 = new Solution();
            $solution1->setNomSolution("banane");
            $question1->addSolution($solution1);

            $solution2 = new Solution();
            $solution2->setNomSolution("chien");
            $question1->addSolution($solution2);
            
            $solution3 = new Solution();
            $solution3->setNomSolution("oui");
            $question2->addSolution($solution3);

            $test->addQuestion($question1);
            $test->addQuestion($question2);
            $entityManager->persist($test);
            $entityManager->persist($question1);
            $entityManager->persist($question2);
            $entityManager->persist($solution1);
            $entityManager->persist($solution2);
            $entityManager->persist($solution3);
        }
        //dd($test->getQuestions());
        $form = $this->createForm(TentativeType::class, $tentative);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tentative->setUser(this->getUser());
            $tentative->setDateTentative(new \Datetime());
            $entityManager->persist($tentative);
            $entityManager->flush();
            return $this->redirectToRoute('app_tentative_index', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('tentative/new.html.twig', [
            'tentative' => $tentative,
            'form' => $form,
            'questions' => $tentative->getTeste()->getQuestions()
        ]);
    }

    #[Route('/{id}', name: 'app_tentative_show', methods: ['GET'])]
    public function show(Tentative $tentative): Response
    {
        return $this->render('tentative/show.html.twig', [
            'tentative' => $tentative,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_tentative_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Tentative $tentative, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TentativeType::class, $tentative);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_tentative_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('tentative/edit.html.twig', [
            'tentative' => $tentative,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_tentative_delete', methods: ['POST'])]
    public function delete(Request $request, Tentative $tentative, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$tentative->getId(), $request->request->get('_token'))) {
            $entityManager->remove($tentative);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_tentative_index', [], Response::HTTP_SEE_OTHER);
    }
}
