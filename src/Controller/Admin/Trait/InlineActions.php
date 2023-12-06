<?php

namespace App\Controller\Admin\Trait;


use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

trait InlineActions
{
    public function configureCrud(Crud $crud): Crud
    {
        return $crud->showEntityActionsInlined(); 
    }
}