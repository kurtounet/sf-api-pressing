<?php

namespace App\Tests;

use App\Entity\User;
use App\Services\EmailNotificationService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class EmailNotificationServiceTest extends KernelTestCase
{
    public function testEmailNotificationService(): void
    {
        $user = new User();
        $user->setEmail("test@test.com");


        $kernel = self::bootKernel();
        $container = static::getContainer();

        $this->assertSame('test', $kernel->getEnvironment());
        // $routerService = static::getContainer()->get('router');
        $emailNotificationService = $container->get(EmailNotificationService::class);
        $emailNotificationService->sendConfirmationEmail($user);
        //$this->assertInstanceOf(EmailNotificationService::class, $EmailNotificationService);
    }
}
