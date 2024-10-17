<?php
namespace App\EventListener;
use App\Entity\Client;
use App\Events\UserRegisteredEvent;
use App\Services\EmailNotificationService;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PostPersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

#[AsDoctrineListener(Events::postPersist)]
class UserPersistListener
{
    public function __construct(
        private EmailNotificationService $emailService,
        private EventDispatcherInterface $eventDispatcher
    ) {
    }
    public function postPersist(PostPersistEventArgs $event): void
    {
        $entity = $event->getObject();
        // Vérifiez que l'entité est un client
        if (!$entity instanceof Client) {
            return;
        }

        $userRegisteredEvent = new UserRegisteredEvent($entity);
        // // Déclenchement de l'événement après que l'utilisateur a été enregistré
        $this->eventDispatcher->dispatch($userRegisteredEvent, UserRegisteredEvent::NAME);


    }
}