<?php

namespace App\Tests;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserEntityrTest extends KernelTestCase
{
    // public function __construct(
    //     private ObjectManager $manager
    //     )
    // {} 
    public function testSomething(): void
    {

        self::bootKernel();
        $container = static::getContainer();
        $user = new Client();
        $user->setFirstname('test')
            ->setLastname('test')
            ->setEmail('test')
            ->setPassword('test')
            ->setRoles(['ROLE_USER']);

        // $this->manager->persist($user);
        // $this->manager->flush();
        $error = $container->get('validator')->validate($user);

        $this->assertCount(0, $error);

        //$this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        // $myCustomService = static::getContainer()->get(CustomService::class);
    }

    public function testGetUser(): void
    {
        $this->assertSame('test', 'test');
    }
}
