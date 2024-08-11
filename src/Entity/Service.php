<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource(
  normalizationContext: ['groups' => ['service:read']],
  denormalizationContext: ['groups' => ['service:write']],
  operations: [
    new Get(),
    new GetCollection(),
    new Post(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"),
    new Patch(security: "is_granted('ROLE_ADMIN' or is_granted('ROLE_MANAGER'))"),
    new Delete(security: "is_granted('ROLE_ADMIN' or is_granted('ROLE_MANAGER'))")
  ]

)]
class Service
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  #[Groups(['service:read', 'service:write', 'category:list:read'])]
  private ?int $id = null;

  #[ORM\Column(length: 100)]
  #[Groups(['service:read', 'service:write', 'category:list:read'])]
  #[Assert\NotBlank]
  #[Assert\Length(max: 100)]
  private ?string $name = null;

  #[ORM\Column]
  #[Groups(['service:read', 'service:write', 'category:list:read'])]
  #[Assert\NotBlank]
  #[Assert\Type(type: 'float')]
  private ?float $price = null;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  #[Groups(['service:read', 'service:write'])]
  private ?string $description = null;

  #[ORM\Column(length: 255, nullable: true)]
  #[Groups(['service:read', 'service:write'])]
  private ?string $image = null;

  /**
   * @var Collection<int, Category>
   */
  #[ORM\ManyToMany(targetEntity: Category::class, inversedBy: 'services')]
  #[Groups(['category:list:read', 'service:read'])]
  private Collection $Category;

  public function __construct()
  {
    $this->Category = new ArrayCollection();
  }

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

  /**
   * @return Collection<int, Category>
   */
  public function getCategory(): Collection
  {
    return $this->Category;
  }

  public function addCategory(Category $category): static
  {
    if (!$this->Category->contains($category)) {
      $this->Category->add($category);
    }

    return $this;
  }

  public function removeCategory(Category $category): static
  {
    $this->Category->removeElement($category);

    return $this;
  }

  public function __toString(): string
  {
    return $this->name ?: '';
  }

}
