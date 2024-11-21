<?php

namespace App\Controller\Admin;

use App\Entity\ItemStatus;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ItemStatusCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ItemStatus::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des status d\'article');
    }
     
}
