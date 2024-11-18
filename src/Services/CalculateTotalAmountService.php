<?php
namespace App\Services;
use App\Entity\Service;

use Doctrine\ORM\EntityManagerInterface;

class CalculateTotalAmountService
{
    public function __construct(
        private EntityManagerInterface $entityManager
    ) {
    }
    public function calculateTotalAmount(array $items): float
    {
        $totalAmount = 0.0;
        if (empty($items)) {
            return $totalAmount;
        }

        // requete sql  pour calculer le montant total

        foreach ($items as $itemData) {
            $id = explode('/', $itemData['service']);
            $service = $this->entityManager->getRepository(Service::class)->find((int) end($id));
            if (!$service) {
                throw new \InvalidArgumentException('Service not found for item');
            }
            $totalAmount += $service->getPrice() * $itemData['quantity'];
        }
        return $totalAmount;
    }
    // public function getItem()
    // {
    //     $stmt = $this->entityManager
    //         ->getConnection()
    //         ->prepare('SELECT SUM(montant) INTO total
    // FROM item
    // WHERE id IN (id1, id2, id3);

    // RETURN total;);

    //     // SELECT SUM(price) AS prix_total
    //     // FROM items
    //     // WHERE facture_id = 1

    //     $stmt->setParameter('mid', 1);    //     
    //     $stmt->execute();
    //     return totalAmount;

    // }

}