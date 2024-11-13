<?php
namespace App\EventListener;
use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
#[AsDoctrineListener(Events::prePersist)]
class NewClientNumberListener
{
    public function __construct(private ClientRepository $clientRepository)
    {
    }
    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();
        if (!$entity instanceof Client) {
            return;
        }
        //On génére un numéro client pour le nouveau client
        $entity->setClientNumber($this->generateClientNumber());
    }
    private function generateClientNumber(): string
    {
        // Récupérer le dernier enregistrement (le dernier client ou null si aucun client n'existe)
        $lastClient = $this->clientRepository->findOneBy([], ['id' => 'DESC']);
        // Si au moins un client existe, on incrémente le numéro du dernier , 
        if ($lastClient) {
            // On ajoute 1 au dernier numéro client
            $number = (int) $lastClient->getClientNumber() + 1;
            // On retourne le numéro client du nouveau client
            return strval($number);
        }
        // Si aucun client n'existe encore on retourne 1
        return '1';
    }

    // public function __construct(
//     private ClientRepository $clientRepository, 
//     private EntityManagerInterface $entityManager
//     ) {}

    // public function prePersist(PrePersistEventArgs $event): void
// {
//     $entity = $event->getObject();
//     if (!$entity instanceof Client) {
//         return;
//     }
//     // On génère un numéro client pour le nouveau client
//     $entity->setClientNumber($this->generateClientNumber());
// }

    // private function generateClientNumber(): string
// {
//     // Créer une requête préparée pour obtenir le dernier client
//     $connection = $this->entityManager->getConnection();
//     $sql = 'SELECT client_number FROM client ORDER BY id DESC LIMIT 1';
//     $stmt = $connection->prepare($sql);
//     $result = $stmt->executeQuery()->fetchAssociative();

    //     if ($result) {
//         // On ajoute 1 au dernier numéro client
//         $number = (int) $result['client_number'] + 1;
//         return strval($number);
//     }
//     // Si aucun client n'existe encore, on retourne 1
//     return '1';
// }


}




// public function __construct(
//     private ClientRepository $clientRepository, 
//     private EntityManagerInterface $entityManager
//     ) {}

// public function prePersist(PrePersistEventArgs $event): void
// {
//     $entity = $event->getObject();
//     if (!$entity instanceof Client) {
//         return;
//     }
//     // On génère un numéro client pour le nouveau client
//     $entity->setClientNumber($this->generateClientNumber());
// }

// private function generateClientNumber(): string
// {
//     // Créer une requête préparée pour obtenir le dernier client
//     $connection = $this->entityManager->getConnection();
//     $sql = 'SELECT client_number FROM client ORDER BY id DESC LIMIT 1';
//     $stmt = $connection->prepare($sql);
//     $result = $stmt->executeQuery()->fetchAssociative();

//     if ($result) {
//         // On ajoute 1 au dernier numéro client
//         $number = (int) $result['client_number'] + 1;
//         return strval($number);
//     }
//     // Si aucun client n'existe encore, on retourne 1
//     return '1';
// }
