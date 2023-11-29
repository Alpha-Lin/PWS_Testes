<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Enum\PossibleRoles;

use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;

class UserCrudController extends AbstractCrudController
{

    use Trait\NoUpdateTrait;

    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('username'),
            TextField::new('password')->onlyWhenCreating(),
            EmailField::new('email'),
            ChoiceField::new('roles')->setChoices(PossibleRoles::cases())->allowMultipleChoices(),
            AssociationField::new('testes')->onlyOnIndex(),
            ArrayField::new('testes')
                ->onlyOnDetail(),
        ];  
    }

}
