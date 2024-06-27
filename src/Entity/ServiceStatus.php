<?php

namespace App\Entity;

use App\Repository\ServiceStatusRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ServiceStatusRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['servicestatus:read']],
    denormalizationContext: ['groups' => ['servicestatus:write']]
)]
class ServiceStatus
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['servicestatus:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['servicestatus:read', 'servicestatus:write'])]
    private ?string $name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }





}
