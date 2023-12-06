<?php

namespace App\Controller\Admin;

use App\Entity\Critere;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;

use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class CritereCrudController extends AbstractCrudController
{

    use Trait\InlineActions;
    public static function getEntityFqcn(): string
    {
        return Critere::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nomCritere'),
            IntegerField::new('scoreMax'),
            IntegerField::new('scoreDefaut'),
            TextField::new('interpretationMaxTexte'),
            TextField::new('interpretationMinTexte'),
            ColorField::new('interpretationMinCouleur'),
            ColorField::new('interpretationMaxCouleur'),
            AssociationField::new('teste')->hideOnForm()
        ];
    }

    
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('nomCritere')
            ->add('scoreMax')
            ->add('scoreDefaut')
            ->add('teste')
        ;
    }

}
