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
    public function __construct(
        private PaymentService $paymentService
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
        // Vérifier les champs obligatoires
        if (!isset($data['filingDate'], $data['returnDate'], $data['paymentDate'], $data['client'], $data['items'])) {
            return new JsonResponse(['message' => 'Missing required fields'], 400);
        }
        // Appel au service de création de commande
        $NewCommande = $createNewCommandeService->execute($data, $user);
        if (!$NewCommande instanceof Commande) {
            return $this->json(['message' => 'Failed creation order'], 422);
        }
        // Retourne la commande comme confirmation de création.
        return $this->json([
            'commande' => $NewCommande,
        ], 201);

    }
}




// Retourner une réponse de succès
//return $this->json([$NewCommande], 201);

// return $this->json([
//     'commande' => $NewCommande,
//     'payment_session_id' => $payment['id']
// ], 201);


// Appel au service de paiement pour créer la session de paiement
// $payment = $this->paymentService->createCheckoutSession($data);
// if (isset($payment['error'])) {
//     return $this->json(['message' => $payment['error']], 400);
// }