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
class SuperUserCrudController extends AbstractCrudController
{

    use Trait\SuperUserTrait;

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
            IdField::new('id')->onlyOnDetail(),
            TextField::new('username'),
            TextField::new('password')->onlyWhenCreating(),
            EmailField::new('email'),
            ChoiceField::new('roles')->setChoices(PossibleRoles::cases())->allowMultipleChoices(),
            ImageField::new('avatar')
                ->setUploadDir('public/uploads/img')
                ->setBasePath('uploads/img')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'), 
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
