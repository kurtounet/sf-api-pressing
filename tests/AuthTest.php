<?php

namespace App\Tests;

use PHPUnit\Framework\Attributes\DataProvider;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AuthTest extends WebTestCase
{
    public function testLogin(): void
    {
        self::bootKernel();
        $username = 'admin@gmail.com';
        $password = 'admin';
        $httpclient = static::createClient();

        // Simuler une requête POST avec les informations d'authentification
        $httpclient->request(
            'POST',
            '/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            '{"username":"' . $username . '","password": "' . $password . '" }'
        );

        $response = $httpclient->getResponse();
        echo "\n" . $response->getStatusCode() . "\n";
        fwrite(STDOUT, "\data\n" . $response->getStatusCode());
        // Vérifier si la réponse est réussie
        // $this->assertSame(200, $response->getStatusCode(), 'La requête de login a échoué.');

        // // Vérifier si la réponse est bien au format JSON
        // $this->assertJson($response->getContent(), 'La réponse n\'est pas au format JSON.');

        // // Convertir le JSON en tableau PHP pour analyse
        // $data = json_decode($response->getContent(), true);

        // // Vérifier que le token JWT est bien présent dans la réponse
        // $this->assertArrayHasKey('token', $data, 'Le token JWT n\'a pas été trouvé dans la réponse.');
    }
}
