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
    ) {

    }

    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();
        if (!$entity instanceof Client) {
            return;
        }

        //$entity->setClientNumber($this->generateClientNumber());
    }
    // public function preUpdate(PreUpdateEventArgs $event): void
    // {
    //     $entity = $event->getObject();
    //     if (!$entity instanceof Client) {
    //         return;
    //     }

    //     $entity->setClientNumber($this->generateClientNumber());
    // }

    private function generateClientNumber(): string
    {
        // Récupérer le dernier client (ou null si aucun client n'existe)
        $lastClient = $this->clientRepository->findBy([], ['id' => 'DESC']);

        // Si un client existe, on incrémente le numéro, sinon on retourne "1"
        if ($lastClient) {
            $number = (int) $lastClient->getClientNumber() + 1;
            return strval($number);
        }

        // Aucun client n'existe encore, donc on commence à 1
        return '1';
    }

}