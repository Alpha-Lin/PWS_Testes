<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Tentatives;
use App\Enum\PossibleRoles;

use App\Form\TesteType;

use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
class UserCrudController extends AbstractCrudController
{

    use Trait\NoUpdateTrait;
    use Trait\InlineActions;

    private UserPasswordHasherInterface $userPasswordHasher;

    public function __construct(UserPasswordHasherInterface $userPasswordHasher) {
         $this->userPasswordHasher = $userPasswordHasher;
    }

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Information utilisateur'),
            IdField::new('id')->onlyOnDetail(),
            TextField::new('username'),
            TextField::new('password')->onlyWhenCreating(),
            EmailField::new('email'),
            ChoiceField::new('roles')->hideOnForm(),
            ImageField::new('avatar')
                ->setUploadDir('public/uploads/img')
                ->setBasePath('uploads/img')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            AssociationField::new('testes'),
            AssociationField::new('Tentatives'),

            FormField::addTab('Testes'),
            AssociationField::new('testes'),
            CollectionField::new('testes')
                ->setTemplatePath('admin/fields/testes.html.twig')
                ->onlyOnDetail(),
            
            FormField::addTab('Tentatives'),
            AssociationField::new('Tentatives'),
            CollectionField::new('Tentatives')            
                ->setTemplatePath('admin/fields/tentatives.html.twig')
                ->onlyOnDetail(),
        ];  
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('username')
            ->add('email')
            ->add('roles')
            ->add('testes')
            ->add('Tentatives')
        ;
    }

    // il faut hasher le mot de passe.
    public function persistEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        if (!$entityInstance instanceof User) return;

        $entityInstance->setPassword(
            $this->userPasswordHasher->hashPassword(
                $entityInstance,
                $entityInstance->getPassword()
            )
        );

        parent::persistEntity($entityManager, $entityInstance);
    }
}
