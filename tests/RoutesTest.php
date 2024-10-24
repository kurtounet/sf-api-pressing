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
        // Ajoute une sorte de "log" via une assertion comptée
        $this->addToAssertionCount(2);
        fwrite(STDOUT, "\nTesting route: /api/" . $route . "\n");

        $response = $httpClient->getResponse();

        // Pour afficher le contenu de la réponse
        $this->assertJson($response->getContent());
        fwrite(STDOUT, "\data\n" . $response->getContent());
        // $data = json_decode($response->getContent(), true);
        // fwrite(STDOUT, "\data\n" . $data);

        // Vérifiez si la réponse est réussie (code HTTP 200)
        //$this->assertSame(200, $response->getStatusCode(), '*****Request failed******');

        // Vérifier la présence d'un token JWT dans la réponse (si nécessaire)
        // $this->assertArrayHasKey('token', $data);
    }
}
