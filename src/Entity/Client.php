<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;




#[ApiResource(
    normalizationContext: ['groups' => ['client:read']],
    denormalizationContext: ['groups' => ['client:write']],
    operations: [
        new Get(),
        new GetCollection(),
        new GetCollection(routeName: 'app_get_commandes_client', name: 'app_get_commandes_client'),
        new Post(),
        new Patch(),
        new Delete()
        // new Post(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"),
        // new Patch(security: "is_granted('ROLE_ADMIN')"),
        // new Delete(security: "is_granted('ROLE_ADMIN')")
    ]

)]
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
    #[Groups(['client:read', 'client:write'])]
    private ?string $clientNumber = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['client:read', 'client:write'])]
    private ?bool $Premium = null;

    /**
     * @var Collection<int, Commande>
     */
    #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'client')]
    #[Groups(['client:read', 'client:write'])]
    private Collection $commande;

    public function __construct()
    {
        parent::__construct();
        $this->commande = new ArrayCollection();
    }

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

    /**
     * @return Collection<int, Commande>
     */
    public function getCommande(): Collection
    {
        return $this->commande;
    }

    public function addCommande(Commande $commande): static
    {
        if (!$this->commande->contains($commande)) {
            $this->commande->add($commande);
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): static
    {
        if ($this->commande->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }
}
