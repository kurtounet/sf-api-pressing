<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Commande;
use App\Entity\Employee;
use App\Entity\Item;
use App\Entity\ItemStatus;
use App\Entity\Service;

use App\Repository\ItemRepository;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Filter\BooleanFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\Filter;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


use EasyCorp\Bundle\EasyAdminBundle\Filter\NumericFilter;
use EasyCorp\Bundle\EasyAdminBundle\Filter\TextFilter;
use Symfony\Component\Security\Core\Security;

class ItemCrudController extends AbstractCrudController
{

    public function __construct(
        private Security $security,
        private ItemRepository $itemRepository
    ) {

    }

    public static function getEntityFqcn(): string
    {
        return Item::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des tâches');
    }


    public function createIndexQueryBuilder(SearchDto $searchDto, EntityDto $entityDto, FieldCollection $fields, FilterCollection $filters): QueryBuilder
    {
        $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

        // Ajout du filtre sur le statut
        // Filtrer sur l'ID ou le nom de itemStatus.name (relation)
        $qb->join('entity.itemStatus', 'status')
            // 'status' est un alias pour la relation
            ->andWhere('status.name IN (:statuses)')
            ->setParameter('statuses', ['En attente', 'En cours']);

        return $qb;

    }


    public function configureActions(Actions $actions): Actions
    {
        // Get the current actions configuration


        // If the user has the ROLE_EMPLOYEE role
        if ($this->isGranted('ROLE_EMPLOYEE')) {
            // Disable the delete and new actions for employees
            $actions = $actions
                ->remove(Crud::PAGE_INDEX, Action::NEW )
                // ->remove(Crud::PAGE_EDIT, Action::DELETE)
                ->remove(Crud::PAGE_INDEX, Action::DELETE);
        }

        // Return the updated actions
        return $actions;
    }

    public function configureFields(string $pageName): iterable
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return [
                AssociationField::new('service')
                    ->setLabel('Service')
                    ->setTextAlign('center')
                    ->setFormTypeOptions([
                        'class' => Service::class,
                        'choice_label' => 'name'
                    ]),

                AssociationField::new('commande')
                    ->setLabel('Commande')
                    ->setFormTypeOptions([
                        'class' => Commande::class,
                        'choice_label' => 'ref'
                    ]),

                NumberField::new('quantity'),

                AssociationField::new('itemStatus')
                    ->setLabel('statut de la tâche')
                    ->setFormTypeOptions([
                        'class' => ItemStatus::class,
                        'choice_label' => 'name'
                    ]),

                TextEditorField::new('detailItem'),

                AssociationField::new('employee')
                    ->setLabel('Employé')
                    ->setFormTypeOptions([
                        'class' => Employee::class,
                        'choice_label' => 'LastName'
                    ]),
            ];
        }


        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return [
                TextField::new('commande')
                    ->setLabel('Commande')
                    ->setTextAlign('center')
                    ->setDisabled(true)

                ,
                TextField::new('service')
                    ->setTextAlign('center')
                    ->setLabel('Service')
                    ->setDisabled(true)
                ,
                AssociationField::new('category')
                    ->setLabel('Catégorie de vêtement')
                    ->setTextAlign('center')
                    ->setDisabled(true)
                    ->setFormTypeOptions([
                        'class' => Category::class,
                        'choice_label' => 'name'
                    ]),

                NumberField::new('quantity')
                    ->setTextAlign('center')
                    ->setDisabled(true),

                AssociationField::new('itemStatus')
                    ->setTextAlign('center')
                    ->setLabel('Statut de la tâche')
                    ->setFormTypeOptions([
                        'class' => ItemStatus::class,
                        'choice_label' => 'name'
                    ]),

                TextEditorField::new('detailItem')
                    ->setTextAlign('center')
                    ->setDisabled(true),

            ];
        }

        return [];
    }


}


