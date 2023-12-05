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

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\ChoiceList\Loader\CallbackChoiceLoader;

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

    #[Route('/teste/{id}', name: 'app_tentative_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, Teste $teste, TesteRepository $testeRepository, QuestionRepository $questionRepository): Response
    {
        $form = $this->createFormBuilder();
        foreach ($teste->getQuestions() as $question) {
            $form->add(
                strval($question->getid()), ChoiceType::class, [
                'choice_value' => 'id',
                'choice_label' => 'nomSolution',
                'label'=> $question->getQuestion(),
                'choices' => $question->getSolutions(),
                'expanded' => false,
                'multiple' => false,
                'required' => true
            ]);
        }
        $form = $form
            ->getForm()
        ;

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $tentative = new Tentative();
            $tentative->setTeste($teste);    
            $tentative->setUser($this->getUser());
            $tentative->setDateTentative(new \Datetime());
            
            dd($form);

            $entityManager->persist($tentative);
            $entityManager->flush();
            return $this->redirectToRoute('app_tentative_show', ["id"=>$tentative->getId()], Response::HTTP_SEE_OTHER);
        }
        
        return $this->render('tentative/new.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/{id}', name: 'app_tentative_show', methods: ['GET'])]
    public function show(Request $request, Tentative $tentative): Response
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
