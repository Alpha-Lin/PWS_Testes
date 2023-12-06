<?php

namespace App\Controller\Admin;

use App\Entity\Teste;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
class TesteCrudController extends AbstractCrudController
{

    use Trait\NoCreateTrait;
    use Trait\InlineActions;

    public static function getEntityFqcn(): string
    {
        return Teste::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            FormField::addTab('Teste')->onlyOnDetail(),
            Field::new('id')->onlyOnIndex(),
            ImageField::new('imageTeste')
                ->setUploadDir('public/uploads/img')
                ->setBasePath('uploads/img')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]'),
            AssociationField::new('user')->onlyOnIndex(),
            AssociationField::new('typeTeste'),

            FormField::addTab('Questions')->onlyOnDetail(),
            ArrayField::new('questions')->onlyOnDetail()
        ];
    }

    
    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('user')
            ->add('typeTeste')
            ->add('questions')
        ;
    }



}
