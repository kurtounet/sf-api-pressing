<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ServiceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ServiceRepository::class)]
#[ApiResource()]
class Service
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 100)]
  private ?string $name = null;

  #[ORM\Column]
  private ?float $price = null;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  private ?string $description = null;

  #[ORM\Column(length: 255, nullable: true)]
  private ?string $image = null;


  /**
   * @var Collection<int, Material>
   */
  #[ORM\ManyToMany(targetEntity: Material::class, mappedBy: 'Service')]
  private Collection $materials;

  public function __construct()
  {
    $this->materials = new ArrayCollection();
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
   * @return Collection<int, Material>
   */
  public function getMaterials(): Collection
  {
    return $this->materials;
  }

  public function addMaterial(Material $material): static
  {
    if (!$this->materials->contains($material)) {
      $this->materials->add($material);
      $material->addService($this);
    }

    return $this;
  }

  public function removeMaterial(Material $material): static
  {
    if ($this->materials->removeElement($material)) {
      $material->removeService($this);
    }

    return $this;
  }
}
