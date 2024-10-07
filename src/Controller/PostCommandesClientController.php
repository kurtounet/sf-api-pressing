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
        ValidatorInterface $validator,
        Security $security,
        EntityManagerInterface $entityManager,
        ItemStatusRepository $itemStatusRepository,
        ClientRepository $clientRepository
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
        // Vérifier que tout les champs obligatoire pour créér une commande, ne soit pas vide.. 
        if (!isset($data['filingDate'], $data['returnDate'], $data['paymentDate'], $data['client'], $data['items'])) {
            return $this->json(['message' => 'Missing required fields'], 400);
        }
        //Récupère le client avec l'id égale à la valeur de $user->getId(), si il existe déjà.
        $client = $clientRepository->findOneBy(['id' => $user->getId()]);
        // Si le client n'existe pas dans la base de donnée
        if (!$client) {
            // Créer un nouveau client à partir de l'utilisateur authentifié
            $client = new Client();
            $entityManager->persist($client);
            $entityManager->flush();
        }
        // Création d'une nouvelle commande
        $commande = new Commande();
        $commande->setClient($client)
            ->setFilingDate(new \DateTime($data['filingDate']))
            ->setReturnDate(new \DateTime($data['returnDate']))
            ->setPaymentDate(new \DateTime($data['paymentDate']));
        // Valider la commande              
        $errors = $validator->validate($commande);
        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[] = $error->getMessage();
            }
            return $this->json(['errors' => $errorMessages], 400);
        }
        // Récupérer l'Id du premier statut "En attente"
        $itemStatus = $itemStatusRepository->findBy(['name' => 'En attente']);
        if (empty($itemStatus)) {
            return $this->json(['message' => 'Status not found'], 404);
        }
        $idItemStatus = $itemStatus[0]->getId();
        // Traitement et persistance des items associés à la commande
        foreach ($data['items'] as $itemData) {
            $item = new Item();
            $item->setCommande($commande)
                ->setService($entityManager->getRepository(Service::class)->find((int) $itemData['service']))
                ->setCategory($entityManager->getRepository(Category::class)->find((int) $itemData['category']))
                ->setItemStatus($entityManager->getRepository(ItemStatus::class)->find($idItemStatus))
                ->setDetailItem($itemData['detailItem'])
                ->setQuantity($itemData['quantity']);
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
            'commandeId' => $commande->getId()
        ], 201);
    }
}