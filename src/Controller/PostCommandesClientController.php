<?php
namespace App\Controller;
use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Item;
use App\Entity\ItemStatus;
use App\Entity\Service;
use App\Repository\ClientRepository;
use App\Repository\ItemStatusRepository;
use App\Services\CalculateTotalAmountService;
use App\Services\CreateNewCommandeService;
use App\Services\StripePaymentService;
use App\Services\CalculateTotalAmount;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostCommandesClientController extends AbstractController
{
    public function __construct(
        //  private StripePaymentService $stripePaymentService
    ) {

    }
    public function __invoke(
        Request $request,
        Security $security,
        CreateNewCommandeService $createNewCommandeService,
    ): JsonResponse {
        // Récupérer l'utilisateur authentifié
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }
        // Décoder le JSON reçu dans le corps de la requête
        $data = json_decode($request->getContent(), true);
        
        // Vérifier si le Json existe et si il y n'a pas d'érreur lors du Décodage         
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['message' => 'Invalid JSON'], 400);
        }
        // Appel au service de création de commande
        $response = $createNewCommandeService->execute($data, $user);
        if ($response instanceof JsonResponse) {
            return $response;
        }
        // Retourner une réponse de succès
        return $this->json([
            'commandeId' => $response->getId()
        ], 201);

    }
}