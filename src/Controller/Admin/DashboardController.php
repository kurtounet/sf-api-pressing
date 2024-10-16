<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Employee;
use App\Entity\Item;
use App\Entity\ItemStatus;
use App\Entity\Profile;
use App\Entity\Service;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }
    #[Route('/admin', name: 'admin')]
    public function index(

    ): Response {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(UserCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        if ($this->isGranted('ROLE_ADMIN')) {

            $allCategories = $this->entityManager->getRepository(Category::class)->findAll();
            shuffle($allCategories);

            $topSellingProduct = array_slice($allCategories, 0, 1)[0]->getName();

            $fourRandomcategories = array_slice($allCategories, 0, 4);
            foreach ($fourRandomcategories as $category) {
                $categories[] = $category->getName();
            }

            $employees = $this->entityManager->getRepository(Employee::class)->findAll();
            shuffle($employees);


            foreach ($employees as $employee) {
                $employeeName[] = $employee->getFirstname() . ' ' . (string) $employee->getLastname();
                $employeeCota[] = random_int(30, 100);
            }

            $monthsLabels = ['Jan', 'Fév', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'];
            //données pour les graphiques
            $salesData = [];
            for ($i = 0; $i < count($monthsLabels); $i++) {
                $salesData[] = random_int(200, 1000);
            }
            $ordersByCategoryData = [];
            for ($i = 0; $i < 4; $i++) {
                $ordersByCategoryData[] =
                    random_int(100, 500);
            }
            $visitorsData = [];
            for ($i = 0; $i < 6; $i++) {
                $visitorsData[] = random_int(0, 1000);

            }
            //$totalSales = $totalOrders = $totalVisitors = 0;
            $totalSales = array_sum($salesData);
            $totalOrders = array_sum($ordersByCategoryData);
            $totalVisitors = array_sum($visitorsData);


            // $categories = ['Category 1', 'Category 2', 'Category 3', 'Category 4'];
            return $this->render('dashboard_admin/index.html.twig', [
                'total_sales' => $totalSales,
                'total_orders' => $totalOrders,
                'total_visitors' => $totalVisitors,
                'month_labels' => $monthsLabels,
                'categories_data' => $categories,
                'top_selling_product' => $topSellingProduct,
                'sales_data' => $salesData,
                'orders_by_category_data' => $ordersByCategoryData,
                'visitors_data' => $visitorsData,
                'employee_cota_data' => $employeeCota,
                'employee_name' => $employeeName,



            ]);

        } else if ($this->isGranted('ROLE_EMPLOYEE')) {
            return $this->redirect($adminUrlGenerator->setController(ItemCrudController::class)->generateUrl());
        } else {
            return $this->redirectToRoute('app_login');
        }


    }


    public function configureAssets(): Assets
    {
        return Assets::new()->addCssFile('css/styles.css');
    }
    public function configureDashboard(): Dashboard
    {
        $user = $this->getUser();
        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return Dashboard::new()
                ->setTitle('Pressing Préstige<br>' . $user->getUserIdentifier())
                ->renderContentMaximized();
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            return Dashboard::new()
                ->setTitle('Pressing Préstige<br>' . $user->getUserIdentifier())
                ->renderContentMaximized();
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

        }

        if ($this->isGranted('ROLE_EMPLOYEE')) {
            yield MenuItem::linkToCrud('Mes tâches', 'fas fa-list', Item::class);

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
                ->add(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER);
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
                ->add(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER);
        }
    }

}
