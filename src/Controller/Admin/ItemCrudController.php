<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use App\Entity\Item;
use App\Entity\ItemStatus;
use App\Entity\Service;
use App\Entity\User;
use App\Repository\ItemRepository;
use Doctrine\Common\Collections\Collection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
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

    // public function getEmployeeItems()
    // {
    //     if ($this->isGranted('ROLE_EMPLOYEE')) {
    //         $user = $this->security->getUser();
    //         $userItems = $this->itemRepository->findBy(['employee' => $user]);
    //         return $userItems;
    //     } else {
    //         throw new \Exception('Accès non autorisé');
    //     }
    // }
    public function configureFields(string $pageName): iterable
    {
        // $userItems = $this->getEmployeeItems();

        if ($this->isGranted('ROLE_ADMIN')) {
            return [
                AssociationField::new('service')
                    ->setLabel('Service')
                    ->setFormTypeOptions([
                        'class' => Service::class,
                        'choice_label' => 'name'
                    ]), // Affiche le champ service pour les employés

                AssociationField::new('commande')
                    ->setLabel('Commande')
                    ->setFormTypeOptions([
                        'class' => Commande::class,
                        'choice_label' => 'ref'
                    ]), // Affiche le champ commande pour les employés

                NumberField::new('quantity'), // Affiche le champ quantity pour les employés

                AssociationField::new('itemStatus')
                    ->setLabel('statut de la tâche')
                    ->setFormTypeOptions([
                        'class' => ItemStatus::class,
                        'choice_label' => 'name'
                    ]), // Affiche le champ itemStatus pour les admins

                TextEditorField::new('detailItem'),

                AssociationField::new('employee')
                    ->setLabel('Employé')
                    ->setFormTypeOptions([
                        'class' => User::class,
                        'choice_label' => 'LastName'
                    ]), // Affiche le champ detailItem pour les employés
            ];


        }

        // if ($this->isGranted('ROLE_EMPLOYEE')) {
        //     return [
        //         AssociationField::new('service')
        //             ->setLabel('Service')
        //             ->setFormTypeOptions([
        //                 'class' => Service::class,
        //                 'choice_label' => 'name'
        //             ]),
        //         AssociationField::new('commande')
        //             ->setLabel('Commande')
        //             ->setFormTypeOptions([
        //                 'class' => Commande::class,
        //                 'choice_label' => 'ref'
        //             ]),
        //         NumberField::new('quantity'),
        //         AssociationField::new('itemStatus')
        //             ->setLabel('Statut de la tâche')
        //             ->setFormTypeOptions([
        //                 'class' => ItemStatus::class,
        //                 'choice_label' => 'name'
        //             ]),
        //         TextEditorField::new('detailItem'),
        //         AssociationField::new('employee')
        //             ->setLabel('Employé')
        //             ->setFormTypeOptions([
        //                 'class' => User::class,
        //                 'choice_label' => 'LastName'
        //             ]),
        //     ];


        // }

    }

}
