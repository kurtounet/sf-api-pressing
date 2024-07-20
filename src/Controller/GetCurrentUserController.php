<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Serializer\SerializerInterface;

class GetCurrentUserController extends AbstractController
{
    #[Route('/api/currentuser', name: 'app_current_user', methods: ['GET'])]
    public function __invoke(
        SerializerInterface $serializer,
        Security $security
    ): JsonResponse {
        $user = $security->getUser();

        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }
        /*
                $data = '';
                if (in_array("ROLE_ADMIN", $user->getRoles())) {
                    $data = $user;
                } else if (in_array("ROLE_MANAGER", $user->getRoles())) {
                    $data = $user;
                } else if (in_array("ROLE_EMPLOYEE", $user->getRoles())) {
                    $data = $user;
                } else if (in_array("ROLE_CLIENT", $user->getRoles())) {
                    $data = $user;
                    //$data = $this->$userRepository->findOneBy($user->getUserIdentifier());

                } else {
                    return $this->json(['message' => 'User not found'], 404);
                }
        */
        //$data = $user;
        return $this->json(
            data: $user,
            context: ['groups' => ['user:read']],
            status: 200

        );


    }
}
