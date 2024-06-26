<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\MaterialRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MaterialRepository::class)]
#[ApiResource()]
class Material
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 100)]
  private ?string $name = null;

  #[ORM\Column]
  private ?float $coeff = null;

  /**
   * @var Collection<int, Service>
   */
  #[ORM\ManyToMany(targetEntity: Service::class, inversedBy: 'materials')]
  private Collection $Service;

  public function __construct()
  {
    $this->Service = new ArrayCollection();
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

  public function getCoeff(): ?float
  {
    return $this->coeff;
  }

  public function setCoeff(float $coeff): static
  {
    $this->coeff = $coeff;

    return $this;
  }





  /**
   * @return Collection<int, Service>
   */
  public function getService(): Collection
  {
    return $this->Service;
  }

  public function addService(Service $service): static
  {
    if (!$this->Service->contains($service)) {
      $this->Service->add($service);
    }

    return $this;
  }

  public function removeService(Service $service): static
  {
    $this->Service->removeElement($service);

    return $this;
  }
}
