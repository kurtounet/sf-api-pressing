<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use PHPUnit\Framework\Attributes\DataProvider;

class RoutesTest extends WebTestCase
{

    public static function routesProvider(): array
    {
        return [
            'users' => ['users']
        ];
    }

    #[DataProvider('routesProvider')]
    public function testRoutes(string $route): void
    {
        $httpClient = static::createClient();
        $httpClient->request('GET', "/api/" . $route);         
        $this->addToAssertionCount(2);
        fwrite(STDOUT, "\nTesting route: /api/" . $route . "\n");
        $response = $httpClient->getResponse();         
        $this->assertJson($response->getContent());
        fwrite(STDOUT, "\data\n" . $response->getContent());       

        
    }
}
