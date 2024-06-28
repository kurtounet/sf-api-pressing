<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\ApiResource;

use App\Repository\EmployeeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

/*
#[ApiResource(
    normalizationContext: ['groups' => ['employee:read']],
    denormalizationContext: ['groups' => ['employee:write']],
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

)]*/
#[ApiResource(
    normalizationContext: ['groups' => ['employee:read']],
    denormalizationContext: ['groups' => ['employee:write']],
    operations: [
        new Get(),
        new GetCollection(),
        new Post(),
        new Patch(),
        new Delete()
    ]
)]
#[ORM\Entity(repositoryClass: EmployeeRepository::class)]
class Employee extends User
{
    /*
        #[ORM\Id]
        #[ORM\GeneratedValue]
        #[ORM\Column]
        
        private ?int $id = null;
        */
    #[Groups(['employee:read', 'employee:write', 'user:read', 'user:write'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $empNumber = null;

    /**
     * @var Collection<int, Item>
     */
    #[Groups(['employee:read', 'employee:write', 'user:read', 'user:write'])]
    #[ORM\OneToMany(targetEntity: Item::class, mappedBy: 'employee')]
    private Collection $items;

    public function __construct()
    {
        parent::__construct();
        $this->items = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmpNumber(): ?string
    {
        return $this->empNumber;
    }

    public function setEmpNumber(?string $empNumber): static
    {
        $this->empNumber = $empNumber;

        return $this;
    }

    /**
     * @return Collection<int, Item>
     */
    public function getItems(): Collection
    {
        return $this->items;
    }

    public function addItem(Item $item): static
    {
        if (!$this->items->contains($item)) {
            $this->items->add($item);
            $item->setEmployee($this);
        }

        return $this;
    }

    public function removeItem(Item $item): static
    {
        if ($this->items->removeElement($item)) {
            // set the owning side to null (unless already changed)
            if ($item->getEmployee() === $this) {
                $item->setEmployee(null);
            }
        }

        return $this;
    }
}
