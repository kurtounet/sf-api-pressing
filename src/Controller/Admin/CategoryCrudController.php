<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Service;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Vich\UploaderBundle\Form\Type\VichImageType;

class CategoryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Category::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des vêtements');

    }
    public function configureFields(string $pageName): iterable
    {
        return [
            //IdField::new('id'),
            TextField::new('name', 'Vêtement'),
            TextField::new('image', 'Image')->setFormType(VichImageType::class)->onlyWhenCreating(),
            AssociationField::new('parent')
                ->setLabel('Catégorie du vêtement')
                ->setFormTypeOptions([
                    'class' => Category::class,
                    'choice_label' => 'name'
                ]),

            ImageField::new('image', 'Image')
                ->setBasePath('/uploads/images/categories')
                ->setUploadDir('public/uploads/images/categories')
            ,
        ];
    }

}
