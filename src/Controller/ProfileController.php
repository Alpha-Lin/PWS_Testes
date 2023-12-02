<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

use App\Scripts\ImageUploader;


#[Route('/profile')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'app_profile', methods: ['GET'])]
    public function index(UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
        
        return $this->render('profile/show.html.twig', [
            'user' => $this->getUser(),
        ]);
    }

    #[Route('/edit', name: 'app_profile_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, EntityManagerInterface $entityManager, ImageUploader $uploader, UserRepository $userRepository): Response
    {
        $user = $this->getUser();

        $form = $this->createFormBuilder($user)
            ->add('username', TextType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('email', EmailType::class, [
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('avatar', FileType::class, [
                'required' => false,
                'data_class' => null,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Please upload a valid image file',
                    ]),
                ],
            ])
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $existingUsernameUser = $userRepository->findOneBy(['username' => $user->getUsername()]);
            $existingEmailUser = $userRepository->findOneBy(['email' => $user->getEmail()]);

            if ($existingUsernameUser && $existingUsernameUser->getId() !== $user->getId()) {
                $form->get('username')->addError(new FormError('Pseudo non disponible.'));
            }

            if (!$form->getErrors()->count()) {
                $user->setUsername($form->get('username')->getData());
                $user->setEmail($form->get('email')->getData());

                if ($existingEmailUser && $existingEmailUser->getId() !== $user->getId()) {
                    $form->get('email')->addError(new FormError('Cet email est deja utilise.'));
                }    

                if ($form->get('avatar')->getData() != null) {
                    $user->setAvatar($uploader->upload($form->get('avatar')->getData()));
                }

                $entityManager->flush();
                return $this->redirectToRoute('app_user_index', [], Response::HTTP_SEE_OTHER);
            }
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form
        ]);

    }
}
