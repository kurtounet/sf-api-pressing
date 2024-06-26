<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\ORM\Mapping\Entity;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
  normalizationContext: ['groups' => ['commande:read']],
  denormalizationContext: ['groups' => ['commande:write']])]
class Commande
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 10)]
  private ?string $ref = null;

  #[ORM\Column(type: Types::DATE_MUTABLE)]
  private ?\DateTimeInterface $filingDate = null;

  #[ORM\Column(type: Types::DATE_MUTABLE)]
  private ?\DateTimeInterface $returnDate = null;

  #[ORM\Column(type: Types::DATE_MUTABLE)]
  private ?\DateTimeInterface $paymentDate = null;

  #[ORM\ManyToOne(inversedBy: 'meansPayment')]
  private ?user $user = null;

  #[ORM\ManyToOne]
  #[ORM\JoinColumn(nullable: false)]
  private ?Meansofpayment $meansPayment = null;




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

  public function getUser(): ?user
  {
    return $this->user;
  }

  public function setUser(?user $user): static
  {
    $this->user = $user;

    return $this;
  }

  public function getMeansPayment(): ?Meansofpayment
  {
    return $this->meansPayment;
  }

  public function setMeansPayment(?Meansofpayment $meansPayment): static
  {
    $this->meansPayment = $meansPayment;

    return $this;
  }





}
