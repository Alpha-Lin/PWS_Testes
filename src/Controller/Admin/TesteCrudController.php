<?php

namespace App\Controller\Admin;

use App\Entity\Teste;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;

class TesteCrudController extends AbstractCrudController
{

    use Trait\ReadOnlyTrait;

    public static function getEntityFqcn(): string
    {
        return Teste::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('First Tab'),
            Field::new('id'),
            // ImageField::new('imageTeste')->setBasePath('path_to_your_image_uploads')->hideOnIndex(),
            AssociationField::new('user')->hideOnIndex(),
            AssociationField::new('typeTeste')->hideOnIndex(),

            FormField::addTab('Questions'),
            ArrayField::new('questions')
        ];
    }



}
