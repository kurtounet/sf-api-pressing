<?php

namespace App\EventListener;

use App\Entity\Client;
use App\Entity\Employee;
use App\Repository\ClientRepository;
use App\Repository\EmployeeRepository;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsDoctrineListener;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;

#[AsDoctrineListener(Events::prePersist)]
//#[AsDoctrineListener(Events::preUpdate)]
//#[AsDoctrineListener(Events::prePersist, entity: User::class)]
class NewEmployeeNumberListener
{
    public function __construct(
        private EmployeeRepository $employeeRepository
    ) {

    }
    public function prePersist(PrePersistEventArgs $event): void
    {
        $entity = $event->getObject();
        if (!$entity instanceof Employee) {
            return;
        }

        $entity->setEmpNumber($this->generateEmployeeNumber());
    }
    // public function preUpdate(PreUpdateEventArgs $args)
    // {
    //      
    // }
    private function generateEmployeeNumber(): string|null
    {
        $lastEmployee = $this->employeeRepository->findOneBy([], ['id' => 'DESC']);
        if ($lastEmployee) {
            $number = (int) $lastEmployee->getEmployeeNumber() + 1;
            return strval($number);
        }
        return '1';
    }
}