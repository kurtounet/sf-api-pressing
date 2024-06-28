<?php

namespace App\Entity;

use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
  normalizationContext: ['groups' => ['category:list']],
  denormalizationContext: ['groups' => ['category:write']],

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
)]
class Category
{
  #[ORM\Id]
  #[ORM\GeneratedValue]
  #[ORM\Column]
  #[Groups(['category:list'])]
  private ?int $id = null;

  #[ORM\Column(length: 50)]
  #[Groups(['category:list'])]
  private ?string $name = null;
  /*
    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'relation')]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children', fetch: 'relation'])
    private ?category $parent = null;
  */
  /*
    /**
     * @var Collection<int, Article>
      

    #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'relation')]
    #[Groups(['categories:list'])]
    private Collection $articles;
   */

  #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'subcategories')]
  #[Groups(['category:list'])]
  private ?self $parent = null;

  /**
   * @var Collection<int, self>
   */
  #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
  #[Groups(['category:list'])]
  private Collection $subcategories;

  /**
   * @var Collection<int, Service>
   */
  #[ORM\ManyToMany(targetEntity: Service::class, mappedBy: 'Category')]
  #[Groups(['category:list'])]
  private Collection $services;

  public function __construct()
  {
    $this->articles = new ArrayCollection();
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


  /*
    /**
     * @return Collection<int, Article>
     
    public function getArticles(): Collection
    {
      return $this->articles;
    }

    public function addArticle(Article $article): static
    {
      if (!$this->articles->contains($article)) {
        $this->articles->add($article);
        $article->setCategory($this);
      }

      return $this;
    }

    public function removeArticle(Article $article): static
    {
      if ($this->articles->removeElement($article)) {
        // set the owning side to null (unless already changed)
        if ($article->getCategory() === $this) {
          $article->setCategory(null);
        }
      }

      return $this;
    }
  */
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
}
