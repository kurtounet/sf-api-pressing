<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Employee;
use App\Entity\Item;
use App\Entity\ItemEtat;
use App\Entity\ItemStatus;
use App\Entity\Material;
use App\Entity\Meansofpayment;
use App\Entity\Service;
use App\Entity\ServiceStatus;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

class AppFixtures extends Fixture
{
    private const PATH = __DIR__ . '/';
    private const PARENT_CATEGORY = [];


    public function __construct(
        private SerializerInterface $serializer
    ) {

    }
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        //SERVICES STATUS
        $content = file_get_contents(self::PATH . 'itemStatus.json');
        // echo $content . "\n";
        $allServiceStatus = $this->serializer->deserialize($content, ItemStatus::class . '[]', 'json');
        foreach ($allServiceStatus as $item) {
            // $item->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $item->setUpdatedAt(new \DateTime('now'));
            //echo $item->getName() . "\n";
            $manager->persist($item);
        }
        echo 'ITEMS STATUS OK' . "\n";

        //SERVICES
        $content = file_get_contents(self::PATH . 'services.json');
        // echo $content . "\n";
        $allServices = $this->serializer->deserialize($content, Service::class . '[]', 'json');
        foreach ($allServices as $item) {
            // $item->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $item->setUpdatedAt(new \DateTime('now'));
            // echo $item->getName() . "\n";
            $manager->persist($item);
        }
        echo 'FIXTURES SERVICE OK' . "\n";

        //CATEGORIES
        $fileContent = file_get_contents(self::PATH . 'categories.json');
        $categoriesData = json_decode($fileContent, true);

        //$categories = $this->serializer->deserialize($filecontent, Category::class . '[]', 'json');

        $allCategories = [];
        foreach ($categoriesData as $item) {
            $category = new Category();
            $category->setName($item['name']);
            if ($item['parent'] == null) {
                $category->setParent(null);
            } else {
                $parentCategory = new Category();
                $parentCategory->setName($item['parent']);
                $category->setParent($parentCategory);
                // $category->setCreatedAt($faker->dateTimeBetween('-2 years'));
                // $category->setUpdatedAt(new \DateTime('now'));
            }
            // $category->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $category->setUpdatedAt(new \DateTime('now'));
            $allCategories[$item['name']] = $category;
            $category->addService($allServices[$faker->numberBetween(0, count($allServices) - 1)]);
            $manager->persist($category);
        }
        //SERVICES_CATEGORIES
        //USERS
        $file_content = file_get_contents(self::PATH . 'users.json');
        $usersData = json_decode($file_content, true);
        // echo $content . "\n";
        //$items = $this->serializer->deserialize($content, User::class . '[]', 'json');
        $allClients = [];
        $allEmployees = [];
        foreach ($usersData as $item) {
            if ($item['roles'][0] === "ROLE_CLIENT") {
                $user = new Client();
                /*
                $client->setClientNumber($faker->numberBetween(100000, 999999));
                $client->setPremium(true);
                $manager->persist($client);
                $clients[] = $client;*/
            } else {
                // echo "\n" . "ROLE_EMPLOYEE" . "\n";
                $user = new Employee();
                /*
                $employee->setEmpNumber($faker->numberBetween(100000, 999999));
                $employee->setRoles($item['roles']);
                $manager->persist($employee);
                $employees[] = $employee;
                */

            }

            // echo $item['email'];
            $user->setEmail($item['email']);
            $user->setRoles($item['roles']);
            $user->setPassword($item['password']);
            $user->setFirstname($item['firstname']);
            $user->setLastname($item['lastname']);
            $user->setMobilephone($item['mobilephone']);
            $user->setPhone($item['phone']);
            $user->setDateborn(new \DateTime($item['dateborn']));
            $user->setNumadrs($item['numadrs']);
            $user->setAdrs($item['adrs']);
            $user->setZipcode($item['zipcode']);
            $user->setCity($item['city']);
            $user->setCountry($item['country']);
            // $user->setCreatedAt($item['CreatedAt']);
            // $user->setUpdatedAt($item['UpdatedAt']);

            // $user->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $user->setUpdatedAt(new \DateTime('now'));

            if ($item['roles'][0] === "ROLE_CLIENT") {
                //echo "\n" . "ROLE_CLIENT" . "\n";
                $user->setClientNumber($faker->numberBetween(100000, 999999));
                $user->setPremium(true);
                $allClients[] = $user;
            } else {
                // echo "\n" . "ROLE_EMPLOYEE" . "\n";
                $user->setEmpNumber(rand(100000, 999999));
                $allEmployees[] = $user;

            }
            $manager->persist($user);
        }
        echo 'FIXTURES USER ok' . "\n";


        /*
                    "id": 7,
                    "ref": "CMD20230007",
                    "user": 7,
                    "filingDate": "2023-05-07",
                    "returnDate": "2023-05-14",
                    "paymentDate": "2023-05-07T14:00:00Z",
                    "meansPayment": 2
        */
        $fileContent = file_get_contents(self::PATH . 'commandes.json');
        $commandeData = json_decode($fileContent, true);
        foreach ($commandeData as $item) {
            // var_dump($clients);
            $commande = new Commande();
            $commande
                ->setRef($item['ref'])
                ->setClient($allClients[rand(0, count($allClients) - 1)])
                ->setFilingDate(new \DateTime($item['filingDate']))
                ->setReturnDate(new \DateTime($item['returnDate']))
                ->setPaymentDate(new \DateTime($item['paymentDate']));
            //->setMeansPayment($allMeansOfPayment[rand(0, count($allMeansOfPayment) - 1)]);
            // ->setCreatedAt($faker->dateTimeBetween('-2 years'))
            // ->setUpdatedAt(new \DateTime('now'));
            $manager->persist($commande);
            $allCommandes[] = $commande;
        }
        echo 'FIXTURES COMMANDE ok' . "\n";

        //ITEMS
        /* 
    "article": 2,
    "service": 1,
    "material": 1,
    "commande": 1,
    "user": 2,
    "itemEtat": 1,
    "serviceStatus": 1,
    "detailItem": "Détail spécifique de l'article.",
    "price": 15.99
    */


        $fileContent = file_get_contents(self::PATH . 'items.json');
        // echo $content . "\n";
        //$items = $this->serializer->deserialize($content, Item::class . '[]', 'json');
        $itemData = json_decode($fileContent, true);

        foreach ($itemData as $item) {

            $newItem = new Item();
            // $newItem->setArticle($allArticles[rand(0, count($allArticles) - 1)]);
            $newItem->setService($allServices[rand(0, count($allServices) - 1)]);
            // $newItem->setMaterial($allMaterials[rand(0, count($allMaterials) - 1)]);
            $newItem->setCommande($allCommandes[rand(0, count($allCommandes) - 1)]);
            $newItem->setEmployee($allEmployees[rand(0, count($allEmployees) - 1)]);
            //  $newItem->setItemEtat($allItemEtats[rand(0, count($allItemEtats) - 1)]);
            $newItem->setItemStatus($allServiceStatus[rand(0, count($allServiceStatus) - 1)]);
            $newItem->setDetailItem(" Rien a signalé");
            $newItem->setPrice(rand(0, 15) . '.' . rand(0, 99));
            $newItem->setQuantity($item['quantity']);
            // $newItem->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $newItem->setUpdatedAt(new \DateTime('now'));

            $manager->persist($newItem);
        }

        echo 'FIXTURES ITEMS ok' . "\n";

        $manager->flush();
    }
}
