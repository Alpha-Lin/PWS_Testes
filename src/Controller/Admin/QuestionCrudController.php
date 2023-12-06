<?php

namespace App\Controller\Admin;

use App\Entity\Question;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
class QuestionCrudController extends AbstractCrudController
{    
    
    use Trait\NoCreateTrait;
    use Trait\InlineActions;

    public static function getEntityFqcn(): string
    {
        return Question::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add('question')
        ;
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
