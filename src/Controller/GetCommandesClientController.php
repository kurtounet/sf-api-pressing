<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;

class GetCommandesClientController extends AbstractController
{
    #[Route('/api/clients/commandes/{id}', name: 'app_get_commandes_client', methods: ['GET'])]
    public function index(
        Security $security,
    ): Response
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        return $this->json(
            data: $user,
            context: ['groups' => ['commande:read']],
            status: 200
        );
    }
}
