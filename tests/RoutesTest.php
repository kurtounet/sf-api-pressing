<?php

namespace App\Tests;

use ApiPlatform\Symfony\Bundle\Test\ApiTestCase;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\Panther\PantherTestCase;
use Symfony\Component\Panther\Client;


class RoutesTest extends ApiTestCase
{
    public function testSomething(): void
    {
        /*
        // Create a Panther client
        $client = self::createPantherClient();

        // Make a request to your API endpoint
        $crawler = $client->request('GET', '/api');

        // Assert the response status code is 200 (OK)
        $this->assertResponseIsSuccessful();

        // Optionally, you can assert specific content on the page
        // For example, if your API returns JSON data, you can decode it and check its content
        $responseContent = $client->getCrawler()->filter('body')->text();
        $responseData = json_decode($responseContent, true);

        // Assert specific content in the response data
        $this->assertArrayHasKey('some_key', $responseData);

        // Alternatively, assert specific text if your API returns HTML
        // $this->assertSelectorTextContains('h1', 'Hello World');
        //$this->assertSelectorTextContains('h1', 'Hello World');
        */
    }
}
