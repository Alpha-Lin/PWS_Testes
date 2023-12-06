<?php

namespace App\Controller;

use App\Entity\Message;
use App\Form\MessageType;
use App\Repository\MessageRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

#[Route('/contact')]
class MessageController extends AbstractController
{
    #[Route('/', name: 'app_message_create', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $message = new Message();
        $form = $this->createForm(MessageType::class, $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $message->setSender($this->getUser());
            $entityManager->persist($message);
            $email = (new Email())
                ->from($message->getSender()->getEmail())
                ->to($message->getReceiver()->getEmail())
                ->subject($message->getObjet())
                ->text($message->getMessage());
            $mailer->send($email);
            $message->setBeenSend(true);
            $entityManager->flush();

            $this->addFlash('success', 'Votre message a ete envoye.');
            return $this->redirectToRoute('app_message_create', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('message/new.html.twig', [
            'message' => $message,
            'form' => $form,
        ]);
    }

}
