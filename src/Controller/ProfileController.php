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

use Symfony\Component\Security\Http\Authentication\UserAuthenticatorInterface;
use App\Security\LoginAuthenticator;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormError;
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
    public function edit(
        Request $request, EntityManagerInterface $entityManager, ImageUploader $uploader, UserRepository $userRepository,
        UserAuthenticatorInterface $userAuthenticator, LoginAuthenticator $authenticator
        ): Response
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

            
            if ($existingEmailUser && $existingEmailUser->getId() !== $user->getId()) {
                $form->get('email')->addError(new FormError('Cet email est deja utilise.'));
            }    

            if (!$form->getErrors()->count()) {
                $user->setUsername($form->get('username')->getData());
                $user->setEmail($form->get('email')->getData());


                if ($form->get('avatar')->getData() != null) {
                    $user->setAvatar($uploader->upload($form->get('avatar')->getData()));
                }

                $entityManager->flush();
                return $this->render('profile/show.html.twig', [
                    'user' => $user
                ]);
            }
        }

        return $this->render('profile/edit.html.twig', [
            'user' => $user,
            'form' => $form
        ]);

    }

    #[Route('/edit-password', name: 'app_profile_password_reset', methods: ['GET', 'POST'])]
    public function editPassword(
        Request $request, EntityManagerInterface $entityManager, ImageUploader $uploader, UserRepository $userRepository,
        UserAuthenticatorInterface $userAuthenticator, LoginAuthenticator $authenticator,
        UserPasswordHasherInterface  $userPasswordHasher
    ): Response
    {
        $user = $this->getUser();

        $form = $this->createFormBuilder()
            ->add('oldPassword', PasswordType::class, [
                'label' => 'Mot de passe',
                'constraints' => [
                    new NotBlank([
                        'message' => 'S\'il vousplait entrez votre mot de passe actuel.',
                    ]),
                ],
            ])
            ->add('newPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => ['label' => 'Nouveau mot de pass'],
                'second_options' => ['label' => 'Repeter nouveau mot de passe'],
                'invalid_message' => 'Les mots de passe ne matchent pas.',
                'constraints' => [
                    new NotBlank([
                        'message' => 'S\'il vous plait entrez un nouveau mot de passe.',
                    ]),
                ]
            ])
            ->getForm();
            
        
        $form->handleRequest($request);
 
        if ($form->isSubmitted() && $form->isValid()) {


            $oldPassword =  $form->get('oldPassword')->getData();
            if (!$userPasswordHasher->isPasswordValid($user, $oldPassword)) {
                $form->get('oldPassword')->addError(new FormError('Mauvais mot de passe.'));
            } else {
                $user->setPassword(
                    $userPasswordHasher->hashPassword(
                        $user,
                        $form->get('newPassword')->getData()
                    )
                );

                $entityManager->flush(); 
                $this->addFlash('success', 'Votre password vient d\'etre mis a jour.');
                return $this->render('profile/show.html.twig', [
                    'user' => $user
                ]);
            }
        }

        return $this->render('profile/edit_password.html.twig', [
            'user' => $user,
            'form' => $form
        ]);
    }
}
