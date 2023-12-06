<?php

namespace App\Controller\Admin;

use App\Entity\Tentative;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class TentativeCrudController extends AbstractCrudController
{

    use Trait\ReadOnlyTrait;
    use Trait\InlineActions;

    public static function getEntityFqcn(): string
    {
        return Tentative::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            DateField::new('dateTentative'),
            AssociationField::new('critereSolutions')
        ];
    }

}
