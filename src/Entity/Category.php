<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\CategoryRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Attribute\Groups;
use Vich\UploaderBundle\Mapping\Annotation as Vich;


#[Vich\Uploadable]
#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['category:list:read']],
    denormalizationContext: ['groups' => ['category:write']],

    operations: [
        new Get(),
        new GetCollection(),
        new Post(security: "is_granted('ROLE_ADMIN') or is_granted('ROLE_MANAGER')"),
        new Patch(security: "is_granted('ROLE_ADMIN')"),
        new Delete(security: "is_granted('ROLE_ADMIN')")
    ]
)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['category:list:read', 'category:write', 'service:read'])]
    private ?int $id = null;


    #[ORM\Column(length: 50)]
    #[Groups(['category:list:read', 'category:write', 'service:read'])]
    private ?string $name = null;

    //  #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'relation')]
    // #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children', fetch: 'relation')]
    // private ?category $parent = null;


    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'subcategories')]
    #[Groups(['category:list:read', 'category:write', 'service:read'])]
    private ?self $parent = null;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    #[Groups(['category:list:read', 'category:write', 'service:read'])]
    private Collection $subcategories;

    /**
     * @var Collection<int, Service>
     */
    #[ORM\ManyToMany(targetEntity: Service::class, mappedBy: 'Category')]
    private Collection $services;

    #[Vich\UploadableField(mapping: 'categories', fileNameProperty: 'image')]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255, nullable: true)]
    #[Groups(['category:list:read', 'category:write', 'service:read'])]
    private ?string $image = null;


    public function __construct()
    {

        $this->subcategories = new ArrayCollection();
        $this->services = new ArrayCollection();
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

    /**
     * @return Collection<int, self>
     */
    public function getSubcategories(): Collection
    {
        return $this->subcategories;
    }

    public function addSubcategory(self $subcategory): static
    {
        if (!$this->subcategories->contains($subcategory)) {
            $this->subcategories->add($subcategory);
            $subcategory->setParent($this);
        }

        return $this;
    }

    public function removeSubcategory(self $subcategory): static
    {
        if ($this->subcategories->removeElement($subcategory)) {
            // set the owning side to null (unless already changed)
            if ($subcategory->getParent() === $this) {
                $subcategory->setParent(null);
            }
        }

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, Service>
     */
    public function getServices(): Collection
    {
        return $this->services;
    }

    public function addService(Service $service): static
    {
        if (!$this->services->contains($service)) {
            $this->services->add($service);
            $service->addCategory($this);
        }

        return $this;
    }

    public function removeService(Service $service): static
    {
        if ($this->services->removeElement($service)) {
            $service->removeCategory($this);
        }

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

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {

            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function __toString(): string
    {
        return $this->name;
    }

}
