<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping\Entity;
use App\Repository\ItemRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ItemRepository::class)]
#[ApiResource()]
class Item
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?article $article = null;

  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?service $service = null;

 

  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?user $user = null;


  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?Commande $commande = null;

  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?ServiceStatus $serviceStatus = null;

  #[ORM\Column(type: Types::TEXT, nullable: true)]
  private ?string $detailItem = null;



  #[ORM\Column]
  private ?float $price = null;

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getArticle(): ?article
  {
    return $this->article;
  }

  public function setArticle(?article $article): static
  {
    $this->article = $article;

    return $this;
  }

  public function getService(): ?service
  {
    return $this->service;
  }

  public function setService(?service $service): static
  {
    $this->service = $service;

    return $this;
  }
 

  public function getUser(): ?user
  {
    return $this->user;
  }

  public function setUser(?user $user): static
  {
    $this->user = $user;

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

  public function getServiceStatus(): ?ServiceStatus
  {
    return $this->serviceStatus;
  }

  public function setServiceStatus(?ServiceStatus $serviceStatus): static
  {
    $this->serviceStatus = $serviceStatus;

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
}
