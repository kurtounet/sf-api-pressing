<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[ApiResource()]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  private ?int $id = null;

  #[ORM\Column(length: 180)]
  private ?string $email = null;

  /**
   * @var list<string> The user roles
   */
  #[ORM\Column]
  private array $roles = [];

  /**
   * @var string The hashed password
   */
  #[ORM\Column]
  private ?string $password = null;

  #[ORM\Column(length: 100)]
  private ?string $firstname = null;

  #[ORM\Column(length: 100)]
  private ?string $lastname = null;

  #[ORM\Column(length: 13, nullable: true)]
  private ?string $mobilephone = null;

  #[ORM\Column(length: 13, nullable: true)]
  private ?string $phone = null;



  #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
  private ?\DateTimeInterface $dateborn = null;

  #[ORM\Column(type: Types::SMALLINT)]
  private ?int $numadrs = null;

  #[ORM\Column(length: 255)]
  private ?string $adrs = null;

  #[ORM\Column(length: 50)]
  private ?string $city = null;

  #[ORM\Column(length: 6)]
  private ?string $zipcode = null;

  #[ORM\Column(length: 6)]
  private ?string $country = null;


  /**
   * @var Collection<int, Commande>
   */
  #[ORM\OneToMany(targetEntity: Commande::class, mappedBy: 'user')]
  private Collection $meansPayment;

  public function __construct()
  {
    $this->meansPayment = new ArrayCollection();
  }

  public function getId(): ?int
  {
    return $this->id;
  }

  public function getEmail(): ?string
  {
    return $this->email;
  }

  public function setEmail(string $email): static
  {
    $this->email = $email;

    return $this;
  }

  /**
   * A visual identifier that represents this user.
   *
   * @see UserInterface
   */
  public function getUserIdentifier(): string
  {
    return (string) $this->email;
  }

  /**
   * @see UserInterface
   *
   * @return list<string>
   */
  public function getRoles(): array
  {
    $roles = $this->roles;
    // guarantee every user at least has ROLE_USER
    $roles[] = 'ROLE_USER';

    return array_unique($roles);
  }

  /**
   * @param list<string> $roles
   */
  public function setRoles(array $roles): static
  {
    $this->roles = $roles;

    return $this;
  }

  /**
   * @see PasswordAuthenticatedUserInterface
   */
  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): static
  {
    $this->password = $password;

    return $this;
  }

  /**
   * @see UserInterface
   */
  public function eraseCredentials(): void
  {
    // If you store any temporary, sensitive data on the user, clear it here
    // $this->plainPassword = null;
  }

  public function getFirstname(): ?string
  {
    return $this->firstname;
  }

  public function setFirstname(string $firstname): static
  {
    $this->firstname = $firstname;

    return $this;
  }

  public function getLastname(): ?string
  {
    return $this->lastname;
  }

  public function setLastname(string $lastname): static
  {
    $this->lastname = $lastname;

    return $this;
  }

  public function getMobilephone(): ?string
  {
    return $this->mobilephone;
  }

  public function setMobilephone(?string $mobilephone): static
  {
    $this->mobilephone = $mobilephone;

    return $this;
  }

  public function getPhone(): ?string
  {
    return $this->phone;
  }

  public function setPhone(?string $phone): static
  {
    $this->phone = $phone;

    return $this;
  }


  public function getDateborn(): ?\DateTimeInterface
  {
    return $this->dateborn;
  }

  public function setDateborn(?\DateTimeInterface $dateborn): static
  {
    $this->dateborn = $dateborn;

    return $this;
  }

  public function getNumadrs(): ?int
  {
    return $this->numadrs;
  }

  public function setNumadrs(int $numadrs): static
  {
    $this->numadrs = $numadrs;

    return $this;
  }

  public function getAdrs(): ?string
  {
    return $this->adrs;
  }

  public function setAdrs(string $adrs): static
  {
    $this->adrs = $adrs;

    return $this;
  }

  public function getCity(): ?string
  {
    return $this->city;
  }

  public function setCity(string $city): static
  {
    $this->city = $city;

    return $this;
  }

  public function getZipcode(): ?string
  {
    return $this->zipcode;
  }

  public function setZipcode(string $zipcode): static
  {
    $this->zipcode = $zipcode;

    return $this;
  }

  public function getCountry(): ?string
  {
    return $this->country;
  }

  public function setCountry(string $country): static
  {
    $this->country = $country;

    return $this;
  }





  /**
   * @return Collection<int, Commande>
   */
  public function getMeansPayment(): Collection
  {
    return $this->meansPayment;
  }

  public function addMeansPayment(Commande $meansPayment): static
  {
    if (!$this->meansPayment->contains($meansPayment)) {
      $this->meansPayment->add($meansPayment);
      $meansPayment->setUser($this);
    }

    return $this;
  }

  public function removeMeansPayment(Commande $meansPayment): static
  {
    if ($this->meansPayment->removeElement($meansPayment)) {
      // set the owning side to null (unless already changed)
      if ($meansPayment->getUser() === $this) {
        $meansPayment->setUser(null);
      }
    }

    return $this;
  }
}