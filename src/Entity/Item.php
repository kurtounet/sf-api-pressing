<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\Metadata\PatchFormatsConfig;
use App\Controller\GetItemsCommandeIdController;
use App\Controller\GetItemsEmployeesController;
use App\Controller\GetItemsNoAssignController;
use Symfony\Component\Validator\Constraints as Assert;
use App\Controller\PostItemsAmountController;
use App\Repository\ItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;



#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[GetCollection(
    uriTemplate: '/items/noassigned',
    controller: GetItemsNoAssignController::class,
    normalizationContext: ['groups' => ['item:read']],
    denormalizationContext: ['groups' => ['item:write']],
    name: 'app_get_items_no_assigned',
)
]
#[GetCollection(
    uriTemplate: '/items/employees',
    controller: GetItemsEmployeesController::class,
    normalizationContext: ['groups' => ['item:employee:read']],
    denormalizationContext: ['groups' => ['item:write']],
    name: 'app_get_items_employee',
)
]
#[GetCollection(
    uriTemplate: '/items/commande/{id}',
    controller: GetItemsCommandeIdController::class,
    normalizationContext: ['groups' => ['item:read']],
    denormalizationContext: ['groups' => ['item:write']],
    name: 'app_get_items_commandes_id',
)
]
#[Post(
    uriTemplate: '/items/amount',
    controller: PostItemsAmountController::class,
    normalizationContext: ['groups' => ['item:amount']],
    denormalizationContext: ['groups' => ['item:amount']],
    name: 'app_post_items_amount',
)
]
#[ApiResource(
    operations: [
        new GetCollection(),
        new Get(),
        new Put(),
        new Patch(inputFormats: ['json' =>
         ['application/merge-patch+json']]),
        new Post(),
        new Delete()
    ],
    normalizationContext: ['groups' =>
     ['item:read', 'item:commande:read']],
    denormalizationContext: ['groups' =>
     ['item:write']]
)]

// new Post(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"),
// new Patch(security: "is_granted('ROLE_ADMIN')"),
// new Delete(security: "is_granted('ROLE_ADMIN')")
class Item
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['item:read', 'employee:items', 'item:employee:read'])]
    private ?int $id = null;
    #[ORM\Column(type: Types::TEXT, nullable: true)]
    #[Groups(['item:read', 'item:write', 'item:employee:read'])]
    private ?string $detailItem = null;

    #[ORM\Column]
    #[Groups(['item:read', 'item:write'])]
    private ?float $price = 0.0;

    #[ORM\Column(type: Types::SMALLINT)]
    #[Groups(['item:read', 'item:write', 'item:employee:read', 'item:amount'])]
    private ?int $quantity = 0;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['item:read', 'item:write', 'employee:items', 'item:employee:read', 'item:amount'])]
    private ?Service $service = null;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'items')]
    #[ORM\JoinColumn(nullable: false, onDelete: 'CASCADE')]
    #[Groups(['item:read', 'item:write', 'item:employee:read'])]
    private ?Commande $commande = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: true)]
    #[Groups(['item:read', 'item:write', 'item:employee:read', 'item:employee:write'])]
    private ?ItemStatus $itemStatus = null;

    #[ORM\ManyToOne(inversedBy: 'items')]
    #[Groups(['item:read', 'item:write'])]
    private ?Employee $employee = null;

    #[ORM\ManyToOne]
    #[Groups(['item:read', 'item:write', 'employee:items', 'item:employee:read'])]
    private ?Category $category = null;

    //


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getService(): ?Service
    {
        return $this->service;
    }

    public function setService(?Service $service): static
    {
        $this->service = $service;

        return $this;
    }


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
        return $this->itemStatus;
    }

    public function setItemStatus(?ItemStatus $itemStatus): static
    {
        $this->itemStatus = $itemStatus;

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
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

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

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
