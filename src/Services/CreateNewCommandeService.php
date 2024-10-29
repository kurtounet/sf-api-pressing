<?php
namespace App\Services;

use App\Entity\Category;
use App\Entity\Client;
use App\Entity\Commande;
use App\Entity\Item;
use App\Entity\ItemStatus;
use App\Entity\Service;
use App\Repository\ClientRepository;
use App\Repository\ItemStatusRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateNewCommandeService
{

    public function __construct(
        private PaymentService $paymentService,
        private ClientRepository $clientRepository,
        private EntityManagerInterface $entityManager,
        private ItemStatusRepository $itemStatusRepository,
        private ValidatorInterface $validator
    ) {
    }

    public function execute(array $data, $user) 
    {
        // Vérifier les champs obligatoires
        if (!isset($data['filingDate'], $data['returnDate'], $data['paymentDate'], $data['client'], $data['items'])) {
            return new JsonResponse(['message' => 'Missing required fields'], 400);
        }

        // Récupérer ou créer le client
        //$client = $this->clientRepository->findOneBy(['id' => $user->getId()]);
        // if (!$client) {
        //     $client = new Client();
        //     $this->entityManager->persist($client);
        //     $this->entityManager->flush();
        // }
        $payment = $this->paymentService->execute($data);
        if ($payment instanceof JsonResponse) {
            return $payment;
        }
        // Création de la commande
        $commande = new Commande();
        $commande->setClient($user)
            ->setFilingDate(new \DateTime($data['filingDate']))
            ->setReturnDate(new \DateTime($data['returnDate']))
            ->setPaymentDate(new \DateTime($data['paymentDate']));

        $errors = $this->validator->validate($commande);
        if (count($errors) > 0) {
            return new JsonResponse($this->getErrorMessages($errors), 400);
        }

        // Récupérer le statut "En attente"
        $itemStatus = $this->itemStatusRepository->findBy(['name' => 'En attente']);
        if (empty($itemStatus)) {
            return new JsonResponse(['message' => 'Status not found'], 404);
        }
        $idItemStatus = $itemStatus[0]->getId();

        // Traitement des items
        foreach ($data['items'] as $itemData) {
            $item = new Item();
            $item->setCommande($commande)
                ->setService($this->entityManager->getRepository(Service::class)->find((int) $itemData['service']))
                ->setCategory($this->entityManager->getRepository(Category::class)->find((int) $itemData['category']))
                ->setItemStatus($this->entityManager->getRepository(ItemStatus::class)->find($idItemStatus))
                ->setDetailItem($itemData['detailItem'])
                ->setQuantity($itemData['quantity']);

            $itemErrors = $this->validator->validate($item);
            if (count($itemErrors) > 0) {
                return new JsonResponse($this->getErrorMessages($itemErrors), 400);
            }

            $this->entityManager->persist($item);
        }

        // Persister la commande
        $this->entityManager->persist($commande);
        $this->entityManager->flush();

        return $commande;
    }

    private function getErrorMessages($errors)
    {
        $errorMessages = [];
        foreach ($errors as $error) {
            $errorMessages[] = $error->getMessage();
        }
        return ['errors' => $errorMessages];
    }
}
