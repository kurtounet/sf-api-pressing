<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetItemsNoAssignController extends AbstractController
{
    // #[Route('/api/items/noassigned', name: 'app_get_items_no_assign')]
    public function __invoke(
        ItemRepository $itemRepository,
        Security $security
    ): JsonResponse {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }


        return $this->json(
            $itemRepository->findBy(
                ['employee' => null],
            ),
            200,
            context: ['groups' => ['service:read', 'item:read', 'commande:list:read', 'itemStatus:read']]
        );
    }
}
