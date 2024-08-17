<?php

namespace App\Controller;

use App\Repository\ItemRepository;
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
        Security       $security
    ): JsonResponse
    {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        // $items = $itemRepository->findBy(['employee' => $user->getId()]);

        // if (!empty($items)) {
        //     return $this->json($items, 200);

        // }

        return $this->json(
            $itemRepository->findBy(['employee' => $user->getId()]),
            200,
            context: ['groups' => ['service:read', 'item:employee:read', 'commande:employee:read', 'itemStatus:read']]
        );
    }
}
