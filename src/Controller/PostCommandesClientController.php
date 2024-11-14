<?php
namespace App\Controller;
use App\Entity\Commande;
use App\Services\CreateNewCommandeService;
use App\Services\PaymentService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostCommandesClientController extends AbstractController
{
    public function __construct(private PaymentService $paymentService){}
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
        // Vérifier si le JSON existe et s'il n'y a pas d'erreur lors du décodage         
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['message' => 'Invalid JSON'], 400);
        }
        // Appel au service de création de commande
        $newCommande = $createNewCommandeService->execute($data, $user);
        if (!$newCommande instanceof Commande) {
            return $this->json(['message' => 'Failed to create order'], 422);
        }
        // Retourner la commande comme confirmation de création
        return $this->json(['commande' => $newCommande,], 201);
    }
}


// Vérifier les champs obligatoires
// if (!isset($data['filingDate'], $data['returnDate'], $data['paymentDate'], $data['client'], $data['items'])) {
//     return new JsonResponse(['message' => 'Missing required fields'], 400);
// }