<?php

namespace App\EventListener;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(Events::prePersist)]
//#[AsDoctrineListener(Events::preUpdate)]
//#[AsDoctrineListener(Events::prePersist, entity: User::class)]
class NewClientNumberListener
{
    public function __construct(
        private ClientRepository $clientRepository

    )
    {

    }

    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();
        if (!$entity instanceof Client) {
            return;
        }

        $entity->setClientNumber($this->generateClientNumber());
    }
    // public function preUpdate(PreUpdateEventArgs $args)
    // {
    //     // Your logic here
    // }
    private function generateClientNumber(): string
    {
        // Generating a client number safely, potentially using a more robust method
        $lastClient = $this->clientRepository->findOneBy([], ['id' => 'DESC']);
        if ($lastClient) {
            $number = (int)$lastClient->getClientNumber() + 1;
            return strval($number); // Incrementing last client's ID for simplicity
        }
        return '1'; // Default to '1' if no clients exist yet
    }
}