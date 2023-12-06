<?php

namespace App\Controller\Admin;

use App\Entity\Tentative;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TentativeCrudController extends AbstractCrudController
{

    use Trait\ReadOnlyTrait;
    use Trait\InlineActions;

    public static function getEntityFqcn(): string
    {
        return Tentative::class;
    }

    
    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
