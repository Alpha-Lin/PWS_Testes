<?php

namespace App\Controller\Admin\Trait;


use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait NoDeleteTrait
{
    public function configureActions(Actions $actions): Actions
    {
        $actions
            ->disable(Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL, Action::NEW, Action::EDIT);
        return $actions;
    }
}
