<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class GetCommandesClientController extends AbstractController
{
    #[Route('/api/client/commandes', name: 'app_get_commandes_client')]
    public function index(
        security $security,
        
        ): Response
    {   
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        return $this->json(
            data: $user,
            context: ['groups' => ['user:read']],
            status: 200
        );
    }
}
