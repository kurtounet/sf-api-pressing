<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\SecurityBundle\Security;


class EmployeeItemsCompleteController extends AbstractController
{
    #[Route('/api/items/{id}/complete', name: 'app_items_complete', methods: ['GET'])]
    public function __invoke(
        Security $security
    ): Response {
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        return $this->json(
            data: $user,
            context: ['groups' => ['user:read']],
            status: 200
        );
    }
}
