<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\PostCommandesAmountController;
use App\Controller\PostCommandesClientController;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[Post(
    uriTemplate: '/commandes/client',
    controller: PostCommandesClientController::class,
    //normalizationContext: ['groups' => ['commande:item:read', 'commande:list:read', 'item:employee:read']],
    denormalizationContext: ['groups' => ['commande:client:write']],
    name: 'app_post_commandes_client',
)
]
 
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new GetCollection(routeName: 'app_get_commandes_no_assign', name: 'app_get_commandes_no_assign'),
        new Post(),
        new Patch(),
        new Delete()
        // new Post(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"),
        // new Patch(security: "is_granted('ROLE_ADMIN')"),
        // new Delete(security: "is_granted('ROLE_ADMIN')")
    ],
    normalizationContext: ['groups' => ['commande:item:read', 'commande:list:read', 'item:employee:read', 'item:client:read']],
    denormalizationContext: ['groups' => ['commande:write']]

)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['commande:item:read', 'commande:list:read', 'commande:employee:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    #[Groups(['commande:client:write', 'commande:item:read', 'commande:list:read', 'commande:write', 'client:read', 'commande:employee:read'])]
    private ?string $ref = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['commande:client:write', 'commande:item:read', 'commande:list:read', 'commande:write', 'client:read'])]
    private ?\DateTimeInterface $filingDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['commande:client:write', 'commande:item:read', 'commande:list:read', 'commande:write', 'client:read'])]
    private ?\DateTimeInterface $returnDate = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    #[Groups(['commande:client:write', 'commande:item:read', 'commande:list:read', 'commande:write', 'client:read'])]
    private ?\DateTimeInterface $paymentDate = null;

    #[ORM\ManyToOne(inversedBy: 'commande')]
    #[Groups(['commande:item:read', 'commande:list:read', 'commande:write', 'client:read'])]
    private ?Client $client = null;

    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'commande', cascade: ['remove'], orphanRemoval: true)]
    #[Groups(['commande:item:read'])]
    private Collection $items;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRef(): ?string
    {
        return $this->ref;
    }

    public function setRef(string $ref): static
    {
        $this->ref = $ref;

        return $this;
    }

    public function getFilingDate(): ?\DateTimeInterface
    {
        return $this->filingDate;
    }

    public function setFilingDate(\DateTimeInterface $filingDate): static
    {
        $this->filingDate = $filingDate;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->returnDate;
    }

    public function setReturnDate(\DateTimeInterface $returnDate): static
    {
        $this->returnDate = $returnDate;

        return $this;
    }

    public function getPaymentDate(): ?\DateTimeInterface
    {
        return $this->paymentDate;
    }

    public function setPaymentDate(\DateTimeInterface $paymentDate): static
    {
        $this->paymentDate = $paymentDate;

        return $this;
    }

    /*
      public function getUser(): ?user
      {
        return $this->user;
      }

      public function setUser(?user $user): static
      {
        $this->user = $user;

        return $this;
      }
    */
    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): static
    {
        $this->client = $client;

        return $this;
    }

    public function __toString(): string
    {
        return $this->ref ?: '';
    }


}
