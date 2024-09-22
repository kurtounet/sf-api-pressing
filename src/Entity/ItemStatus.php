<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\ItemStatusRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ItemStatusRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['itemStatus:read']],
    denormalizationContext: ['groups' => ['itemStatus:write']],
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
    #[Groups(['itemStatus:read', 'item:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    #[Groups(['itemStatus:read', 'itemStatus:write', 'item:read'])]
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

    public function __toString(): string
    {
        return $this->name ?: '';
    }
}
