<?php

namespace App\EventSubscriber;

use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

//#[AsDoctrineListener]
//#[AsEntityListener(events: [Events::prePersist, Events::preUpdate], entity: User::class)]
class HashUserPasswordSubscriber
{
    public function __construct(private UserPasswordHasherInterface $hasher)
    {
    }

    public function getSubscribedEvents(): array
    {
        return [

            Events::prePersist,
            Events::preUpdate,

        ];
    }

    public function prePersist(PrePersistEventArgs $args): void //PrePersistEventArgs $args
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }

        $entity->setPassword($this->hasher->hashPassword($entity, $entity->getPassword()));
    }

    public function preUpdate(PreUpdateEventArgs $args): void //PreUpdateEventArgs $args
    {
        $entity = $args->getObject();

        if (!$entity instanceof User) {
            return;
        }

        $entity->setPassword($this->hasher->hashPassword($entity, $entity->getPassword()));
    }
}