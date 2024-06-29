<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;

class RoutesTest extends ApiTestCase
{
    const METHODS_HTTP = ['POST', 'GET', 'PATCH', 'DELETE'];
    const CONTENT_TYPE = 'application/ld+json';

    public function testRoutes(): void
    {
        /*
            $category = {
              "@id": "/api/categories/10",
              "@type": "Category",
              "id": 10,
              "name": "Vêtements",
              "subcategories": [],
              "services": [
                "/api/services/45"
              ]
            };*/
        // Récupérer le token d'authentification
        $token = $this->getAuthenticationToken();

        // Récupérer la liste des routes de l'API
        $routes = $this->getApiRoutes($token);

        // Tester chaque route avec différentes méthodes HTTP
        foreach ($routes as $route) {
            foreach (self::METHODS_HTTP as $method) {
                echo "\n" . $method . ' - ' . $route . "\n";
                $resp = $this->callRoute($method, $route, $token);
                var_dump($resp);
                die();
                //$this->assertContains('200', $resp->getStatusCode());
                // $this->callRoute('GET', $route . '/' . $id, $token);
            }
            /*
                        foreach (self::METHODS_HTTP as $method) {
                            $this->callRoute($method, $route, $token);
                        }
                            */
        }
    }

    private function getAuthenticationToken(): string
    {
        $response = static::createClient()->request(
            'POST',
            '/api/login_check',
            [
                'json' => [
                    'username' => 'admin@gmail.com',
                    'password' => 'Jean'
                ]
            ]
        );

        return json_decode($response->getContent(), true)['token'];
    }

    private function getApiRoutes($token): array
    {
        $response = static::createClient()->request(
            'GET',
            '/api',
            [
                'headers' => [
                    'Content-Type' => self::CONTENT_TYPE,
                    'Authorization' => 'Bearer ' . $token
                ]
            ]
        );

        $routes = json_decode($response->getContent(), true);

        // Supposant que les routes sont dans un format structuré ; 
        // ajustez selon la structure de réponse de votre API
        return array_slice($routes, 3);
        // Ajuster le découpage en fonction de la structure de réponse de votre API
    }

    private function callRoute($methode, $route, $token): string
    {
        $response = static::createClient()->request(
            $methode,
            $route,
            [
                'headers' => [
                    'Content-Type' => self::CONTENT_TYPE,
                    'Authorization' => 'Bearer ' . $token
                ]
            ]
        );

        echo $response->getStatusCode();
        // Gérer la réponse en fonction des résultats attendus
        switch ($methode) {
            case 'GET':
                if ($response->getStatusCode() === 200) {
                    echo "$route (GET) - OK\n";
                } elseif ($response->getStatusCode() === 404) {
                    echo "$route (GET) - Ressource non trouvée\n";
                }
                break;
            case 'POST':
                // Gérer les codes de réponse POST
                break;
            case 'PATCH':
                // Gérer les codes de réponse PATCH
                break;
            case 'DELETE':
                // Gérer les codes de réponse DELETE
                break;
            default:
                // Gérer les méthodes non supportées
                break;
        }

    }
}
