<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Employee;
use App\Entity\Item;
use App\Entity\ItemStatus;
use App\Entity\Service;
use App\Entity\User;
use App\Entity\Profile;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirect($adminUrlGenerator->setController(CommandeCrudController::class)->generateUrl());
            ;
        } else if ($this->isGranted('ROLE_EMPLOYEE')) {
            return $this->redirect($adminUrlGenerator->setController(ItemCrudController::class)->generateUrl());
        } else {
            return $this->redirectToRoute('app_login');
        }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        $user = $this->getUser();
        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return Dashboard::new()
                ->setTitle('Pressing Préstige<br>' . $user->getUserIdentifier())
                ->renderContentMaximized()
            ;
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            return Dashboard::new()
                ->setTitle('Pressing Préstige<br>' . $user->getUserIdentifier())
                ->renderContentMaximized()
            ;
        }

        return Dashboard::new();
    }

    public function configureMenuItems(): iterable
    {

        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');

        if ($this->isGranted('ROLE_ADMIN')) {
            yield MenuItem::subMenu('Utilisateurs', 'fa fa-users')->setSubItems([
                MenuItem::linkToCrud('Liste des utilisateurs', 'fas fa-users', User::class),
                MenuItem::linkToCrud('Liste des Clients', 'fas fa-user-tie', Client::class),
                MenuItem::linkToCrud('Liste des Employés', 'fas fa-user-cog', Employee::class),
            ]);

            yield MenuItem::linkToCrud('Liste des Commandes', 'fas fa-box', Commande::class);
            yield MenuItem::linkToCrud('Liste des Tâches', 'fas fa-tasks', Item::class);
            yield MenuItem::linkToCrud('Liste des Services', 'fas fa-concierge-bell', Service::class);
            yield MenuItem::linkToCrud('Liste des Vêtements', 'fas fa-tshirt', Category::class);
            yield MenuItem::linkToCrud('Liste des Statuts', 'fas fa-info-circle', ItemStatus::class);
            yield MenuItem::linkToCrud('Mon Profil', 'fas fa-user', User::class);
        }

        if ($this->isGranted('ROLE_EMPLOYEE')) {
            yield MenuItem::linkToCrud('Mes tâches', 'fas fa-list', Item::class);
            yield MenuItem::linkToCrud('Mon Profile', 'fas fa-list', User::class);
        }


    }

    public function configureActions(): Actions
    {
        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return Actions::new()
                ->addBatchAction(Action::BATCH_DELETE)
                ->add(Crud::PAGE_INDEX, Action::NEW )
                ->add(Crud::PAGE_INDEX, Action::EDIT)
                ->add(Crud::PAGE_INDEX, Action::DELETE)

                ->add(Crud::PAGE_DETAIL, Action::EDIT)
                ->add(Crud::PAGE_DETAIL, Action::INDEX)
                ->add(Crud::PAGE_DETAIL, Action::DELETE)

                ->add(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN)
                ->add(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE)

                ->add(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)
                ->add(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER)
            ;
        }
        if ($this->isGranted('ROLE_ADMIN')) {
            return Actions::new()
                ->addBatchAction(Action::BATCH_DELETE)
                ->add(Crud::PAGE_INDEX, Action::NEW )
                ->add(Crud::PAGE_INDEX, Action::EDIT)
                ->add(Crud::PAGE_INDEX, Action::DELETE)

                ->add(Crud::PAGE_DETAIL, Action::EDIT)
                ->add(Crud::PAGE_DETAIL, Action::INDEX)
                ->add(Crud::PAGE_DETAIL, Action::DELETE)

                ->add(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN)
                ->add(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE)

                ->add(Crud::PAGE_NEW, Action::SAVE_AND_RETURN)
                ->add(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER)
            ;
        }
    }

}
