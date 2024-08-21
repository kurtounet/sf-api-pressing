<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;

class GetCommandesClientController extends AbstractController
{
    //#[Route('/api/clients/{id}/commandes', name: 'app_get_commandes_client', methods: ['GET'])]
    public function __invoke(
        CommandeRepository $commandeRepository,
        Security $security
    ): JsonResponse {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        // $items = $itemRepository->findBy(['employee' => $user->getId()]);

        // if (!empty($items)) {
        //     return $this->json($items, 200);

        // }

        return $this->json(
            $commandeRepository->findBy(['client' => $user->getId()]),
            200,
            context: ['groups' => ['commande:item:read']]
        );
    }
}
