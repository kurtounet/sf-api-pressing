<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource]
#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{
    /*
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
*/
    #[ORM\Column(length: 255)]
    private ?string $clientNumber = null;

    #[ORM\Column(nullable: true)]
    private ?bool $Premium = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClientNumber(): ?string
    {
        return $this->clientNumber;
    }

    public function setClientNumber(string $clientNumber): static
    {
        $this->clientNumber = $clientNumber;

        return $this;
    }

    public function isPremium(): ?bool
    {
        return $this->Premium;
    }

    public function setPremium(?bool $Premium): static
    {
        $this->Premium = $Premium;

        return $this;
    }
}
