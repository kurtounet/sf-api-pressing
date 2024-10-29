<?php
namespace App\EventListener;
use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
#[AsDoctrineListener(Events::prePersist)]
class NewCommandeNumberListener
{
    public function __construct(private CommandeRepository $commandeRepository)
    {
    }
    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();
        if (!$entity instanceof Commande) {
            return;
        }
        $entity->setRef($this->generateCommandeNumber());
    }
    private function generateCommandeNumber(): string
    {
        $lastCommande = $this->commandeRepository->findOneBy([], ['id' => 'DESC']);
        if ($lastCommande) {
            $number = (int) $lastCommande->getRef() + 1;
            return strval($number);
        }
        return '1';
    }
}