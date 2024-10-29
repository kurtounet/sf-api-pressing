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
        fwrite(STDOUT, "\nIdentifiant: " .
         $email . "\nPassword: " . $password . "\n");
        // Creer le client HTTP
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
        // Recupérer le contenu de la requête          
        $data = json_decode($client->getResponse()->getContent(),
         true);
        // Vérifier la présence des token dans la réponse
        $this->assertArrayHasKey('token', $data);
        $this->assertArrayHasKey('refresh_token', $data);
        // Afficher le contenu des token
        fwrite(STDOUT, "\n[x]Token: " . 
        $data['token'] . "\n");
        fwrite(STDOUT, "\n[x]refresh_token: " .
        $data['refresh_token'] . "\n");       
    }
}
 // Utiliser le token pour accéder à une ressource protégée
        // $token = $data['token'];
        // $client->request('GET', '/api/protected_resource', [], [], [
        //     'HTTP_AUTHORIZATION' => 'Bearer ' . $token,
        // ]);

        // // Vérifier que l'accès est autorisé
        // $this->assertResponseIsSuccessful();
        // $this->assertSelectorTextContains('h1', 'Ressource protégée'); // Vérifiez le contenu attendu
    
    // $crawler = $client->request('GET', '/');

    // $this->assertResponseIsSuccessful();
    // $this->assertSelectorTextContains('h1', 'Hello World');

