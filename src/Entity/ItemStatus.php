<?php

namespace App\Entity;

use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\ServiceStatusRepository;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ServiceStatusRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['servicestatus:read']],
    denormalizationContext: ['groups' => ['servicestatus:write']],
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Patch(),
        new Delete()
        // new Post(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"),
        // new Patch(security: "is_granted('ROLE_ADMIN')"),
        // new Delete(security: "is_granted('ROLE_ADMIN')")
    ]

)]
class ItemStatus
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
