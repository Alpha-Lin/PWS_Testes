<?php

namespace App\Controller\Admin;

use App\Entity\Message;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SubmitType;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;

use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;

class MessageCrudController extends AbstractCrudController
{   

    use Trait\ReadDeleteTrait;
    use Trait\InlineActions;
 
    public static function getEntityFqcn(): string
    {
        return Message::class;
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add(TextFilter::new('objet'))
            ->add('beenSend')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->onlyOnDetail(),
            TextField::new('objet'),
            TextField::new('message'),
            BooleanField::new('beenSend')->renderAsSwitch(false)
        ];
    }

}
