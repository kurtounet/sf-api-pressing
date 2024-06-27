<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource(
  normalizationContext: ['groups' => ['service:read']],
  denormalizationContext: ['groups' => ['service:write']]
)]
class Service
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 100)]
  #[Groups(['service:read', 'service:write'])]
  private ?string $name = null;

  #[ORM\Column]
  #[Groups(['service:read', 'service:write'])]
  private ?float $price = null;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  #[Groups(['service:read', 'service:write'])]
  private ?string $description = null;

  #[ORM\Column(length: 255, nullable: true)]
  #[Groups(['service:read', 'service:write'])]
  private ?string $image = null;



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

  public function getPrice(): ?float
  {
    return $this->price;
  }

  public function setPrice(float $price): static
  {
    $this->price = $price;

    return $this;
  }

  public function getDescription(): ?string
  {
    return $this->description;
  }

  public function setDescription(?string $description): static
  {
    $this->description = $description;

    return $this;
  }

  public function getImage(): ?string
  {
    return $this->image;
  }

  public function setImage(?string $image): static
  {
    $this->image = $image;

    return $this;
  }

}
