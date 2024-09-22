<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Serializer\SerializerInterface;

class GetCurrentUserController extends AbstractController
{
    #[Route('/api/currentuser', name: 'app_current_user', methods: ['GET'])]
    public function __invoke(
<<<<<<< HEAD
        SerializerInterface $serializer,
        Security            $security
    ): JsonResponse
    {
=======
        //SerializerInterface $serializer,
        Security $security
    ): JsonResponse {
>>>>>>> d7739d2e9739382551b51c1eeb1a45348b997cce
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
