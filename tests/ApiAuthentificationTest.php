<?php
namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiAuthentificationTest extends WebTestCase
{
    public function testLoginWithValidCredentials(): void
    {
        $email = 'admin@gmail.com';
        $password = 'admin';
        // Afficher les identifiants
        fwrite(STDOUT, "\nIdentifiant : " . $email . 
        "\nMot de passe : " . $password . "\n");
        // Créer le client HTTP
        $client = static::createClient();
        // Envoyer la requête de connexion
        $client->request(
            'POST',
            'http://localhost:8001/api/login_check',
            [],
            [],
            ['CONTENT_TYPE' => 'application/json'],
            json_encode([
                'username' => $email,
                'password' => $password,
            ])
        );
        // Vérifier si la réponse est réussie
        $this->assertResponseIsSuccessful();
        // Récupérer le contenu de la réponse
        $data = json_decode($client->getResponse()->getContent(),
         true);
        // Vérifier la présence des tokens dans la réponse
        $this->assertArrayHasKey('token', $data);
        $this->assertArrayHasKey('refresh_token', $data);
        // Afficher le contenu des tokens
        fwrite(STDOUT, "\n[x] Token : " . 
        $data['token'] . "\n");
        fwrite(STDOUT, "\n[x] Refresh Token : " .
         $data['refresh_token'] . "\n");
    }
}