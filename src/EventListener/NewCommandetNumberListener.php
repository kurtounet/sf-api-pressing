<?php

namespace App\EventListener;


use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;

use Doctrine\ORM\Events;


#[AsDoctrineListener(Events::prePersist)]
#[AsDoctrineListener(Events::preUpdate)]
//#[AsDoctrineListener(Events::prePersist, entity: User::class)]
class NewCommandetNumberListener
{
    public function __construct(
        private CommandeRepository $commandeRepository

    ) {

    }

    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();
        if (!$entity instanceof Commande) {
            return;
        }

        $entity->setRef($this->generateCommandeNumber());
    }
    public function preUpdate(PreUpdateEventArgs $event): void
    {
        $entity = $event->getObject();
        if (!$entity instanceof Commande) {
            return;
        }
       // $entity->setRef($this->generateCommandeNumber());
    }


    private function generateCommandeNumber(): string
    {
        // Generating a client number safely, potentially using a more robust method
        $lastCommande = $this->commandeRepository->findOneBy([], ['id' => 'DESC']);
        if ($lastCommande) {
            $number = (int) $lastCommande->getCommandeNumber() + 1;
            return strval($number); // Incrementing last client's ID for simplicity
        }
        return '1'; // Default to '1' if no clients exist yet
    }
}