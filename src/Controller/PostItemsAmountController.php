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
    public function __invoke(
        Request $request,
        Security $security,
        CalculateTotalAmountService $amountService,
        EntityManagerInterface $entityManager
    ): JsonResponse {
        // Récupérer l'utilisateur connecté
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }
        // Décoder le JSON reçu dans le corps de la requête
        $items = json_decode($request->getContent(), true);
        // Vérifier si le JSON existe et s'il n'y a pas d'erreur lors du décodage
        if ($items === null && json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['message' => 'Invalid JSON'], 400);
        }
        $totalAmount = $amountService->calculateTotalAmount($items);
        return $this->json(['amount' => $totalAmount,'status' => 200]);
    }
}

