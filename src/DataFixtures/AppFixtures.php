<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use App\Entity\Commande;
use App\Entity\Item;
use App\Entity\ItemEtat;
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

        /*
        >- Article.php  
        >- Category.php    
        >- Commande.php 
        >- Item.php  
              
        >- Service.php (fait) ok
        >- ServiceStatus.php (fait) ok
        >- ItemEtat.php  (fait)

        >- Material.php (fait)  
        >- Meansofpayment.php (fait)
        >- User.php (fait) ok
        */

        $faker = Factory::create();

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

        //SERVICES STATUS
        $content = file_get_contents(self::PATH . 'serviceStatus.json');
        // echo $content . "\n";
        $allServiceStatus = $this->serializer->deserialize($content, ServiceStatus::class . '[]', 'json');
        foreach ($allServiceStatus as $item) {
            // $item->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $item->setUpdatedAt(new \DateTime('now'));
            //echo $item->getName() . "\n";
            $manager->persist($item);
        }
        echo 'SERVICES STATUS OK' . "\n";

        //ITEMS STATES
        $content = file_get_contents(self::PATH . 'itemStates.json');
        // echo $content . "\n";
        $allItemEtats = $this->serializer->deserialize($content, ItemEtat::class . '[]', 'json');
        foreach ($allItemEtats as $item) {
            // $item->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $item->setUpdatedAt(new \DateTime('now'));
            //echo $item->getName() . "\n";
            $manager->persist($item);
        }
        echo 'ITEMS ETAT OK' . "\n";

        //MATERIALS
        $content = file_get_contents(self::PATH . 'materials.json');
        // echo $content . "\n";
        $allMaterials = $this->serializer->deserialize($content, Material::class . '[]', 'json');
        foreach ($allMaterials as $item) {
            // $item->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $item->setUpdatedAt(new \DateTime('now'));
            // echo $item->getName() . "\n";
            $manager->persist($item);
        }
        echo 'MATERIALS OK' . "\n";

        //MEANS OF PAYMENT
        $content = file_get_contents(self::PATH . 'meansOfPayments.json');
        // echo $content . "\n";
        $allMeansOfPayment = $this->serializer->deserialize($content, Meansofpayment::class . '[]', 'json');
        foreach ($allMeansOfPayment as $item) {
            // $item->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $item->setUpdatedAt(new \DateTime('now'));
            //echo $item->getName() . "\n";
            $manager->persist($item);
        }
        echo 'FIXTURES MEANS OF PAYMENT ok' . "\n";

        //USERS
        $file_content = file_get_contents(self::PATH . 'users.json');
        $users = json_decode($file_content, true);
        // echo $content . "\n";
        //$items = $this->serializer->deserialize($content, User::class . '[]', 'json');
        $clients = [];
        foreach ($users as $item) {
            $user = new User();
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
            $user->setPassword($item['password']);
            // $user->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $user->setUpdatedAt(new \DateTime('now'));

            if ($item['roles'][0] === "ROLE_CLIENT") {

                $clients[] = $user;
            }
            $manager->persist($user);
        }

        echo 'FIXTURES USER ok' . "\n";


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
            $manager->persist($category);

        }
        //dd($allCategories);
        echo 'FIXTURES CATEGORY ok' . "\n";
        //ARTICLES       
        $fileContent = file_get_contents(self::PATH . 'articles.json');
        $articleData = json_decode($fileContent, true);
        foreach ($articleData as $item) {

            $article = new Article();
            $article->setName($item['name']);
            $article->setCategory($allCategories[$item['category']]);
            $article->setUrlimage($item['urlimage']);
            // $article->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $article->setUpdatedAt(new \DateTime('now'));
            $allArticles[] = $article;
            $manager->persist($article);
        }
        echo 'FIXTURES ARTICLE ok' . "\n";
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
                ->setUser($clients[rand(0, count($clients) - 1)])
                ->setFilingDate(new \DateTime($item['filingDate']))
                ->setReturnDate(new \DateTime($item['returnDate']))
                ->setPaymentDate(new \DateTime($item['paymentDate']))
                ->setMeansPayment($allMeansOfPayment[rand(0, count($allMeansOfPayment) - 1)]);
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


        $content = file_get_contents(self::PATH . 'items.json');
        // echo $content . "\n";
        //$items = $this->serializer->deserialize($content, Item::class . '[]', 'json');
        $itemData = json_decode($fileContent, true);

        foreach ($itemData as $item) {

            $newItem = new Item();
            $newItem->setArticle($allArticles[rand(0, count($allArticles) - 1)]);
            $newItem->setService($allServices[rand(0, count($allServices) - 1)]);
            $newItem->setMaterial($allMaterials[rand(0, count($allMaterials) - 1)]);
            $newItem->setCommande($allCommandes[rand(0, count($allCommandes) - 1)]);
            $newItem->setUser($clients[rand(0, count($clients) - 1)]);
            $newItem->setItemEtat($allItemEtats[rand(0, count($allItemEtats) - 1)]);
            $newItem->setServiceStatus($allServiceStatus[rand(0, count($allServiceStatus) - 1)]);
            $newItem->setDetailItem(" Rien a signalé");
            $newItem->setPrice(rand(0, 15) . '.' . rand(0, 99));
            // $newItem->setCreatedAt($faker->dateTimeBetween('-2 years'));
            // $newItem->setUpdatedAt(new \DateTime('now'));

            $manager->persist($newItem);
        }

        echo 'FIXTURES ITEMS ok' . "\n";


        $manager->flush();
    }
}















