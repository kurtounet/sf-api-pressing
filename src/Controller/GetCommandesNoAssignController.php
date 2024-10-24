<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;


class GetCommandesNoAssignController extends AbstractController
{
    //#[Route('/api/commandes/noassign', name: 'app_get_commandes_no_assign', methods: ['GET'])]
    public function __invoke(
        Security $security,
        CommandeRepository $commandeRepository
    ): JsonResponse {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }
        $commandes = $commandeRepository->findAll();

        return $this->json(
            data: $commandes,
            context: ['groups' => ['commande:read']],
            status: 200
        );
    }
}
