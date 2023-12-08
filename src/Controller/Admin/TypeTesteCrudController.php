<?php

namespace App\Controller\Admin;

use App\Entity\TypeTeste;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class TypeTesteCrudController extends AbstractCrudController
{   
    use Trait\NoDeleteTrait;
    use Trait\InlineActions;

    public static function getEntityFqcn(): string
    {
        return TypeTeste::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('label'),
            TextField::new('description')
        ];
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('label')
            ->add('description')
        ;
    }

}
