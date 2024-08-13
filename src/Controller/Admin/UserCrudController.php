<?php

namespace App\Controller\Admin;

use App\Entity\User;
use Doctrine\Common\Collections\Collection;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TelephoneField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\PasswordHasher\Type\PasswordTypePasswordHasherExtension;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Liste des utilisateurs')
            ->setPageTitle(Crud::PAGE_NEW, 'Nouvel utilisateurs')
            ->setPageTitle(Crud::PAGE_EDIT, 'Utilisateur');
    }

    public function configureFields(string $pageName): iterable
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return [
                // IdField::new('id')->hideOnForm(),
                FormField::addColumn(6),
                FormField::addFieldset('Utilisateur'),
                TextField::new('firstname', 'Nom'),
                TextField::new('lastname', 'Prénom'),
                EmailField::new('email', 'Email'),
                TelephoneField::new('mobilephone', 'Téléphone mobile')->hideOnIndex(),
                TelephoneField::new('phone', 'Téléphone')->hideOnIndex(),
                DateField::new('dateborn', 'Date de naissance')->hideOnIndex(),
                FormField::addColumn(6),
                FormField::addFieldset('Authentification'),
                ChoiceField::new('roles', 'Roles')
                    ->setChoices([
                        'Client' => 'ROLE_USER',
                        'Employé' => 'ROLE_EMPLOYEE',
                        'Administrateur' => 'ROLE_ADMIN',

                    ])
                    ->allowMultipleChoices(),




                // TextField::new('password', 'Password')->onlyOnForms(), // Ne montrer que dans les formulaires
                FormField::addFieldset('Adresse'),
                NumberField::new('numadrs', 'Nb de rue')->hideOnIndex(),
                TextField::new('adrs', 'Addresse')->hideOnIndex(),
                TextField::new('city', 'Ville'),
                TextField::new('zipcode', 'Code Postal'),
                TextField::new('country', 'Pays'),
            ];

        }

        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return [
                // IdField::new('id')->hideOnForm(),
                FormField::addColumn(6),

                FormField::addFieldset('Utilisateur'),

                TextField::new('firstname', 'Nom'),
                TextField::new('lastname', 'Prénom'),
                TelephoneField::new('mobilephone', 'Téléphone mobile')->hideOnIndex(),
                TelephoneField::new('phone', 'Téléphone')->hideOnIndex(),
                DateField::new('dateborn', 'Date de naissance')->hideOnIndex(),

                FormField::addColumn(6),

                FormField::addFieldset('Authentification'),
                EmailField::new('email', 'Email'),
                TextField::new('password', 'Mot de passe')->setFormType(PasswordType::class)->onlyOnForms(),

                FormField::addFieldset('Adresse'),
                NumberField::new('numadrs', 'Nb de rue')->hideOnIndex(),
                TextField::new('adrs', 'Addresse')->hideOnIndex(),
                TextField::new('city', 'Ville'),
                TextField::new('zipcode', 'Code postal'),
                TextField::new('country', 'Pays'),
            ];
        }

    }
}
