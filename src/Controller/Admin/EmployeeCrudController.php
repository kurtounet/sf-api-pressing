<?php

namespace App\Controller\Admin;

use App\Entity\Employee;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class EmployeeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Employee::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des clients');
    }

     

}
