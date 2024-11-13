<?php

namespace App\DataFixtures;

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
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;
use Symfony\Component\Serializer\SerializerInterface;

class AppFixtures extends Fixture
{
    private const PATH = __DIR__ . '/';
    private const PARENT_CATEGORY = [];


    public function __construct(private SerializerInterface $serializer) {}
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $content = file_get_contents(self::PATH . 'itemStatus.json');
        $allServiceStatus = $this->serializer->deserialize($content,ItemStatus::class . '[]','json');
        foreach ($allServiceStatus as $item) {
            $manager->persist($item);
        }
        echo 'ITEMS STATUS OK' . "\n";
        $content = file_get_contents(self::PATH . 'services.json');
        $allServices = $this->serializer->deserialize( $content,Service::class . '[]','json');
        foreach ($allServices as $item) {
            $manager->persist($item);
        }
        echo 'FIXTURES SERVICE OK' . "\n";
        //CATEGORIES
        $fileContent = file_get_contents(self::PATH . 'categories.json');
        $categoriesData = json_decode($fileContent, true);
        $allCategories = [];
        foreach ($categoriesData as $item) {
            $category = new Category();
            $category->setName($item['name']);
            $category->setParent(null);
            $category->setImage($item['image']);
            $allCategories[$item['name']] = $category;
            $category->addService($allServices[$faker->numberBetween(
                0,
                count($allServices) - 1
            )]);
            $manager->persist($category);
        }
        //SERVICES_CATEGORIES
        //USERS
        $file_content = file_get_contents(self::PATH . 'users.json');
        $usersData = json_decode($file_content, true);
        $allClients = [];
        $allEmployees = [];
        $iclient = 1000;
        $iemploy = 1000;
        foreach ($usersData as $item) {
            if ($item['roles'][0] === "ROLE_CLIENT") {
                $user = new Client();
            } else {
                $user = new Employee();
            }
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

            if ($item['roles'][0] === "ROLE_CLIENT") {

                $user->setClientNumber(strval($iclient++));
                $user->setPremium(false);

                $allClients[] = $user;
            } else {

                $user->setEmpNumber(strval($iemploy++));
                $allEmployees[] = $user;

            }
            $manager->persist($user);
        }
        echo 'FIXTURES USER ok' . "\n";

        $fileContent = file_get_contents(self::PATH . 'commandes.json');
        $commandeData = json_decode($fileContent, true);
        $i = 1000;
        // commenter : $entity->setRef($this->generateCommandeNumber());
        // dans NewCommandeNumberListener
        foreach ($commandeData as $item) {
            $i++;
            echo $i . "\n";
            $commande = new Commande();
            $commande
                ->setRef(strval($i))
                ->setClient($allClients[rand(0, count($allClients) - 1)])
                ->setFilingDate(new \DateTime($item['filingDate']))
                ->setReturnDate(new \DateTime($item['returnDate']))
                ->setPaymentDate(new \DateTime($item['paymentDate']));
            $manager->persist($commande);
            $allCommandes[] = $commande;
        }
        echo 'FIXTURES COMMANDE ok' . "\n";


        $fileContent = file_get_contents(self::PATH . 'items.json');
        $itemData = json_decode($fileContent, true);

        foreach ($itemData as $item) {

            $newItem = new Item();

            $newItem->setService($allServices[rand(0, count($allServices) - 1)]);

            $newItem->setCommande($allCommandes[rand(0, count($allCommandes) - 1)]);
            $newItem->setEmployee($allEmployees[rand(0, count($allEmployees) - 1)]);

            $newItem->setItemStatus($allServiceStatus[rand(0, count($allServiceStatus) - 1)]);
            $newItem->setDetailItem(" Rien a signalé");
            $newItem->setPrice(rand(0, 15) . '.' . rand(0, 99));
            $newItem->setQuantity($item['quantity']);
            $manager->persist($newItem);
        }

        echo 'FIXTURES ITEMS ok' . "\n";

        $manager->flush();
    }
}
