<?php

namespace App\Tests;

use App\Entity\User;
use PHPUnit\Framework\TestCase;

class UserTest extends TestCase
{

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();
        $this->user = new User();
    }


    public function testGetEmail(): void
    {
        $email = 'test@gmail.com';
        $firstname = 'test';

        $this->user->setEmail($email)
            ->setFirstname($firstname);

        $this->assertInstanceOf(User::class, $this->user);
        $this->assertEquals($email, $this->user->getEmail());
        $this->assertEquals($firstname, $this->user->getFirstname());

    }
}
