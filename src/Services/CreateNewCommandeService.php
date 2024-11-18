<?php
namespace App\Services;
use App\Entity\Category;
use App\Entity\Commande;
use App\Entity\Item;
use App\Entity\ItemStatus;
use App\Entity\Service;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class CreateNewCommandeService
{
    public function __construct(
        private PaymentService $paymentService,
        private EntityManagerInterface $entityManager,
        private ValidatorInterface $validator
    ) {
    }

    public function execute(array $data, $user)
    {
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
        $itemStatus = $this->entityManager->getRepository(ItemStatus::class)
            ->findBy(['name' => 'En attente']);
        //$itemStatus = $this->itemStatusRepository->findBy(['name' => 'En attente']);
        if (empty($itemStatus)) {
            return new JsonResponse(['message' => 'Status not found'], 404);
        }
        $idItemStatus = $itemStatus[0]->getId();
        // Création des items
        foreach ($data['items'] as $itemData) {
            $item = new Item();
            $item->setCommande($commande)
                ->setService($this->entityManager->getRepository(className: Service::class)->find(
                    (int) $itemData['service']))
                ->setCategory($this->entityManager->getRepository(Category::class)->find(
                    (int) $itemData['category']))
                ->setItemStatus($this->entityManager->getRepository(ItemStatus::class)->find(
                    $idItemStatus))
                ->setDetailItem($itemData['detailItem'])
                ->setQuantity($itemData['quantity']);

            $itemErrors = $this->validator->validate($item);
            if (count($itemErrors) > 0) {
                return new JsonResponse($this->getErrorMessages($itemErrors), 400);
            }
            // Ajouter les items dans la file d'attente pour être persister
            $this->entityManager->persist($item);
        }
        // Ajouter la commande dans la file d'attente pour être persister
        $this->entityManager->persist($commande);
        // Insères la commande et les items en base de donnée
        $this->entityManager->flush();
        // retourne lea commande
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

// Récupérer ou créer le client
//$client = $this->clientRepository->findOneBy(['id' => $user->getId()]);
// if (!$client) {
//     $client = new Client();
//     $this->entityManager->persist($client);
//     $this->entityManager->flush();
// }

// $payment = $this->paymentService->execute($data);
// if ($payment instanceof JsonResponse) {
//     return $payment;
// }