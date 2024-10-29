<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\SecurityBundle\Security; // Correct namespace for Security

class GetEmployeeItemsController extends AbstractController
{
    //#[Route('/api/items/employee', name: 'app_get_items_employee', methods: ['GET'])]
    public function __invoke(
        ItemRepository $itemRepository,
        Security $security
    ): JsonResponse {
        $user = $this->getUser();


        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }
        return $this->json(['items' => $user], 200);
        // Récupération des articles spécifiques à l'employé connecté
        //$items = $itemRepository->findBy(['employee' => $user->getId()]);
        // $items = $itemRepository->findAll();
        // return $this->json(['items' => $user], 200);
        // return $this->json(
        //     data: '$items',
        //     context: ['groups' => ['item:employee:read']],
        //     status: 200
        // );

    }
}
