<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;


class GetClientCommandesController extends AbstractController
{
    //#[Route('/api/clients/commandes', name: 'app_get_clients_commandes', methods: ['GET'])]
    public function __invoke(
        CommandeRepository $commandeRepository,
        Security $security,
    ): JsonResponse {
        $user = $security->getUser();

        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }
        $commandes = $commandeRepository->findBy(['client' => $user->getId()]);

        return $this->json(
            $commandes,
            200,
            context: ['groups' => ['commande:item:read', 'item:read']]
        );
    }
}
