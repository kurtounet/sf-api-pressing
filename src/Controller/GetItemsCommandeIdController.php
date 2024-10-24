<?php

namespace App\Controller;

use App\Repository\CommandeRepository;
use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;


class GetItemsCommandeIdController extends AbstractController
{
    // Route: /items/commande/{id}
    public function __invoke(
        int $id,
        ItemRepository $itemRepository,
        Security $security
    ): JsonResponse {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }


        $itemsList = $itemRepository->findBy(['commande' => $id]);


        // Vérifiez si le tableau n'est pas vide
        if (!empty($itemsList)) {
            // Récupérer le premier statut trouvé
            $items = $itemsList;
            


            return $this->json(
                $items,
                200,
                context: ['groups' => ['item:read', 'itemStatus:read']]
            );
        } else {
            return $this->json(['message' => 'Items not found'], 404);
        }


    }
}
