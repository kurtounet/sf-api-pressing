<?php

namespace App\Tests;

use App\Entity\Client;
use App\Entity\User;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class UserEntityrTest extends KernelTestCase
{
     
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

        
        $error = $container->get('validator')->validate($user);

        $this->assertCount(0, $error);

         
    }

    public function testGetUser(): void
    {
        $this->assertSame('test', 'test');
    }
}
