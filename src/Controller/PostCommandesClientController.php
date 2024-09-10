<?php

namespace App\Controller;

use App\Entity\Category;
use App\Entity\Commande;
use App\Entity\Item;
use App\Entity\Service;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PostCommandesClientController extends AbstractController
{
    public function __invoke(
        Request $request,
        EntityManagerInterface $entityManager,
        ValidatorInterface $validator,
        Security $security,
        ClientRepository $clientRepository // Ajout du repository client
    ): JsonResponse {
        // Récupérer l'utilisateur authentifié
        $user = $security->getUser();
        if (!$user) {
            return $this->json(['message' => 'User not found'], 404);
        }

        // Décodage du JSON reçu dans la requête
        $data = json_decode($request->getContent(), true);

        // Vérification de la validité du JSON
        if ($data === null && json_last_error() !== JSON_ERROR_NONE) {
            return $this->json(['message' => 'Invalid JSON'], 400);
        }

        // Vérification des champs obligatoires
        if (!isset($data['filingDate'], $data['returnDate'], $data['paymentDate'], $data['client'], $data['items'])) {
            return $this->json(['message' => 'Missing required fields'], 400);
        }

        // Récupérer le client à partir de l'URL (exemple : /api/clients/24)
        $clientId = (int) filter_var($data['client'], FILTER_SANITIZE_NUMBER_INT);
        $client = $clientRepository->find($clientId);

        if (!$client) {
            return $this->json(['message' => 'Client not found'], 404);
        }

        // Création d'une nouvelle commande
        $commande = new Commande();
        $commande->setClient($client);
        $commande->setFilingDate(new \DateTime($data['filingDate']));
        $commande->setReturnDate(new \DateTime($data['returnDate']));
        $commande->setPaymentDate(new \DateTime($data['paymentDate']));

        // Valider la commande
        $errors = $validator->validate($commande);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], 400);
        }

        // Traitement et persistance des items associés à la commande
        foreach ($data['items'] as $itemData) {
            $item = new Item();
            $item->setCommande($commande); // Associer l'item à la commande
            $item->setService($entityManager->getRepository(Service::class)->find(
                (int) filter_var($itemData['service'], FILTER_SANITIZE_NUMBER_INT)
            ));
            $item->setCategory($entityManager->getRepository(Category::class)->find(
                (int) filter_var($itemData['category'], FILTER_SANITIZE_NUMBER_INT)
            ));
            $item->setDetailItem($itemData['detailItem']);
            $item->setQuantity($itemData['quantity']);

            // Valider chaque item
            $itemErrors = $validator->validate($item);
            if (count($itemErrors) > 0) {
                $errorMessages = [];
                foreach ($itemErrors as $error) {
                    $errorMessages[] = $error->getMessage();
                }
                return $this->json(['errors' => $errorMessages], 400);
            }

            // Persister chaque item
            $entityManager->persist($item);
        }

        // Persister la commande et ses items en base de données
        $entityManager->persist($commande);
        $entityManager->flush();

        // Retourner une réponse de succès
        return $this->json([
            'message' => 'Commande and items successfully created',
            'commandeId' => $commande->getId()
        ], 201);
    }
}