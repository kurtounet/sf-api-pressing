<?php

namespace App\Controller;

use App\Repository\ItemRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security; // Correct namespace for Security

class GetEmployeeItemsController extends AbstractController
{
    #[Route('/api/items/employee', name: 'app_get_items_employee', methods: ['GET'])]
    public function __invoke(
        ItemRepository $itemRepository,
        Security $security
    ): JsonResponse {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        // Récupération des articles spécifiques à l'employé connecté
        // $items = $itemRepository->findBy(['employee' => $user->getId()]);
        // return $this->json(
        //     data: $items,
        //     context: ['groups' => ['item:read']],
        //     status: 200
        // );
        return $this->json(['message' => 'ok'], 200);
    }
}
// #[Route('/api/currentuser', name: 'app_current_user', methods: ['GET'])]
//     public function __invoke(
//         //SerializerInterface $serializer,
//         Security $security
//     ): JsonResponse {
//         $user = $security->getUser();

//         if (!$user) {
//             return $this->json(['message' => 'User not found'], 404);
//         }

//         return $this->json(
//             data: $user,
//             context: ['groups' => ['user:read']],
//             status: 200

//         );


//     }