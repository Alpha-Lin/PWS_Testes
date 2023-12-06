<?php

namespace App\Controller\Admin\Trait;

use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait SuperUserTrait
{
    public function configureActions(Actions $actions): Actions
    {
        $actions->disable()->add(Crud::PAGE_INDEX, Action::DETAIL, Action::NEW, Action::EDIT, Action::DELETE);
        return $actions;
    }

    
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->setEntityPermission('SUPER_ADMIN_ROLE')->showEntityActionsInlined();
    }
}
