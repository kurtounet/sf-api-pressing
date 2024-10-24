<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthenticationTest extends WebTestCase
{
    public function authentication(): void
    {
        $client = static::createClient();
        $client->request('POST', '/api/login_check', ['username' => 'admin@gmail.com', 'password' => 'admin']);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('token', $client->getResponse()->getContent());
        $this->assertEquals(404, $client->getResponse()->getStatusCode());
        $this->assertStringContainsString('token', $client->getResponse()->getContent());
    }
}
