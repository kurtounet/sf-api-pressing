<?php
namespace App\EventListener;
use App\Entity\Client;
use App\Service\EmailNotificationService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(Events::postPersist)]
class UserRegistrationListener
{
    public function __construct(
        private EmailNotificationService $emailService
    ) {
    }
    public function postPersist(PostPersistEventArgs $event): void
    {
        $entity = $event->getObject();
        // Vérifiez que l'entité est un client
        if (!$entity instanceof Client) {
            return;
        }
        // Envoyer l'e-mail
        $this->emailService->sendConfirmationEmail($entity);
    }
}