<?php

namespace App\Entity;

use App\Repository\EmployeeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee extends User
{
    /*
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        private ?int $id = null;
    */
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $empNumber = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmpNumber(): ?string
    {
        return $this->empNumber;
    }

    public function setEmpNumber(?string $empNumber): static
    {
        $this->empNumber = $empNumber;

        return $this;
    }
}
