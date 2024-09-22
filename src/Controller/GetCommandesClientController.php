<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;

class GetCommandesClientController extends AbstractController
{
    #[Route('/api/clients/commandes/{id}', name: 'app_get_commandes_client', methods: ['GET'])]
    public function index(
        CommandeRepository $commandeRepository,
        Security $security,
    ): JsonResponse {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }



        return $this->json(
            $commandeRepository->findBy(['client' => $user->getId()]),
            200,
            context: ['groups' => ['commande:item:read', 'item:read']]
        );
    }
}
