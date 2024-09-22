<?php

namespace App\Entity;


use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\HasLifecycleCallbacks]
#[ORM\UniqueConstraint(name: 'UNIQ_IDENTIFIER_EMAIL', fields: ['email'])]
#[UniqueEntity(fields: ['email'], message: 'Il existe déjà un compte avec cette adresse email')]
#[ORM\InheritanceType('JOINED')]
#[ORM\DiscriminatorColumn(name: 'discr', type: 'string')]
#[ORM\DiscriminatorMap([
    'user' => User::class,
    'client' => Client::class,
    'employee' => Employee::class
])]
#[ApiResource(
    operations: [
        new Get(),
        new GetCollection(),
        new GetCollection(routeName: 'app_current_user', name: 'app_current_user'),
        new Post(),
        new Patch(),
        new Delete()
        // new Post(security: "is_granted('ROLE_ADMIN')"),
        // new Patch(security: "is_granted('ROLE_ADMIN')"),
        // new Delete(security: "is_granted('ROLE_ADMIN')")
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:write']]

)]

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(["user:read", "employee:read", "client:read", "user:write", "employee:write", "client:write"])]
    protected ?int $id = null;

    #[ORM\Column(length: 180)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $email = null;


    #[ORM\Column]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private array $roles = [];


    #[ORM\Column]
    //#[ORM\PrePersist]
    //#[ORM\PreUpdate]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $password = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"

    ])]
    private ?string $firstname = null;

    #[ORM\Column(length: 100, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $lastname = null;

    #[ORM\Column(length: 13, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $mobilephone = null;


    #[ORM\Column(length: 13, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $phone = null;
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateborn = null;

    #[ORM\Column(type: Types::SMALLINT, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?int $numadrs = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $adrs = null;

    #[ORM\Column(length: 50, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $city = null;

    #[ORM\Column(length: 6, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $zipcode = null;

    #[ORM\Column(length: 6, nullable: true)]
    #[Groups([
        "user:read",
        "employee:read",
        "client:read",
        "user:write",
        "employee:write",
        "client:write"
    ])]
    private ?string $country = null;

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


    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }


    public function getRoles(): array
    {
        $roles = $this->roles;

        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }


    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }


    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }


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

    public function __toString(): string
    {
        return $this->lastname . ' ' . $this->firstname ?: '';
    }

}
