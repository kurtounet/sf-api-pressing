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

}