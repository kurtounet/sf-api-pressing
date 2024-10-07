<?php


namespace App\EventListener;

use App\Entity\Client;
use App\Entity\User;

use App\Service\EmailNotificationService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(Events::prePersist)]
class UserRegistrationListener
{
    //private EmailNotificationService $emailService;

    public function __construct(private EmailNotificationService $emailService)
    {
        $this->emailService = $emailService;
    }

    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();

        // Vérifiez que l'entité est un utilisateur
        if (!$entity instanceof Client) {
            return;
        }

        // Envoyer l'e-mail de bienvenue
        $this->emailService->sendConfirmationEmail($entity);
    }
}