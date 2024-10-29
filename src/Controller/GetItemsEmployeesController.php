<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use App\Repository\ItemStatusRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
class GetItemsEmployeesController extends AbstractController
{
    //#[Route('/api/employees/{id}/items', name: 'app_get_employees_items', methods: ['GET'])]
    public function __invoke(
        ItemRepository $itemRepository,
        ItemStatusRepository $itemStatusRepository,
        Security $security
    ): JsonResponse {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        $criteriaStatus = $itemStatusRepository->findBy(['name' => ['En attente', 'En cours']]);

        // Vérifiez si le tableau n'est pas vide
        if (!empty($criteriaStatus)) {
            // Récupérer le premier statut trouvé
            $status = $criteriaStatus[0];
            // Récuperer l'ID de l'objet Status
            $idStatus = $status->getId();

            return $this->json(
                $itemRepository->findBy(['employee' => $user->getId(), 'itemStatus' => $idStatus]),
                200,
                context: ['groups' => ['service:read', 'item:employee:read', 'commande:employee:read', 'itemStatus:read']]
            );
        } else {
            return $this->json(['message' => 'Status not found'], 404);
        }

    }
}
