<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\ApiResource;

use App\Repository\ItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ApiResource(
  normalizationContext: ['groups' => ['item:read']],
  denormalizationContext: ['groups' => ['item:write']],
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
class Item
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  #[Groups(['item:read'])]
  private ?int $id = null;

  /*
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(
      ['item:read', 'item:write', 'article:read:item'])]
    private ?Article $article = null;
  */
  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(['item:read', 'item:write'])]
  private ?Service $service = null;
  /*
    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['item:read', 'item:write'])]
    private ?User $user = null;
  */

  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(['item:read', 'item:write'])]
  private ?Commande $commande = null;

  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  #[Groups(['item:read', 'item:write'])]
  private ?ItemStatus $ItemStatus = null;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  #[Groups(['item:read', 'item:write'])]
  private ?string $detailItem = null;

  #[ORM\Column]
  #[Groups(['item:read', 'item:write'])]
  private ?float $price = null;

  #[ORM\Column(type: Types::SMALLINT)]
  #[Groups(['item:read'])]
  private ?int $Quantity = null;

  #[ORM\ManyToOne(inversedBy: 'items')]
  #[Groups(['item:read'])]
  private ?Employee $employee = null;

  public function getId(): ?int
  {
    return $this->id;
  }
  /*
    public function getArticle(): ?Article
    {
      return $this->article;
    }

    public function setArticle(?Article $article): static
    {
      $this->article = $article;

      return $this;
    }
  */
  public function getService(): ?Service
  {
    return $this->service;
  }

  public function setService(?Service $service): static
  {
    $this->service = $service;

    return $this;
  }

  /*
    public function getUser(): ?User
    {
      return $this->user;
    }

    public function setUser(?User $user): static
    {
      $this->user = $user;

      return $this;
    }
  */

  public function getCommande(): ?Commande
  {
    return $this->commande;
  }

  public function setCommande(?Commande $commande): static
  {
    $this->commande = $commande;

    return $this;
  }

  public function getItemStatus(): ?ItemStatus
  {
    return $this->ItemStatus;
  }

  public function setItemStatus(?ItemStatus $ItemStatus): static
  {
    $this->ItemStatus = $ItemStatus;

    return $this;
  }

  public function getDetailItem(): ?string
  {
    return $this->detailItem;
  }

  public function setDetailItem(?string $detailItem): static
  {
    $this->detailItem = $detailItem;

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

  public function getQuantity(): ?int
  {
    return $this->Quantity;
  }

  public function setQuantity(int $Quantity): static
  {
    $this->Quantity = $Quantity;

    return $this;
  }

  public function getEmployee(): ?Employee
  {
    return $this->employee;
  }

  public function setEmployee(?Employee $employee): static
  {
    $this->employee = $employee;

    return $this;
  }
}
