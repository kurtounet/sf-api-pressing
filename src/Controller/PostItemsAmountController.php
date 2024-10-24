<?php

namespace App\Controller;


use App\Entity\Service;
use App\Services\CalculateTotalAmountService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;
class PostItemsAmountController extends AbstractController
{
    // #[Route('/api/commandes/noassign', name: 'app_get_commandes_no_assign', methods: ['GET'])]
    public function __invoke(
        Request $request,
        Security $security,
        CalculateTotalAmountService $AmountService,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();

        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        // Décoder le JSON reçu dans le corps de la requête
        $items = json_decode($request->getContent(), true);

        // Vérifier si le Json existe et si il y n'a pas d'érreur lors du Décodage         
        if ($items === null && json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['message' => 'Invalid JSON'], 400);
        }

        $totalAmount = $AmountService->calculateTotalAmount($items);
        return $this->json([
            'amount' => $totalAmount,
            'status' => 200
        ]);
    }
}
