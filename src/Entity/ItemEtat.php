<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ItemEtatRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemEtatRepository::class)]
#[ApiResource()]
class ItemEtat
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 100)]
  private ?string $state = null;

  #[ORM\Column]
  private ?float $coeff = null;


  public function getId(): ?int
  {
    return $this->id;
  }

  public function getstate(): ?string
  {
    return $this->state;
  }

  public function setstate(string $state): static
  {
    $this->state = $state;

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





}
