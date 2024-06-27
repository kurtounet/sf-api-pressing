<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;


#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ApiResource(
  normalizationContext: ['groups' => ['category:read']],
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
  #[Groups(['category:read'])]
  private ?int $id = null;

  #[ORM\Column(length: 50)]
  #[Groups(['category:read', 'category:write'])]
  private ?string $name = null;
  /*
    //#[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'relation')]
    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children', fetch: 'relation']
    private ?category $parent = null;
  */

  /**
   * @var Collection<int, Article>
   */
  #[Groups(['category:read'])]
  #[ORM\OneToMany(targetEntity: Article::class, mappedBy: 'relation')]
  private Collection $articles;

  #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'subcategories')]
  #[Groups(['category:read'])]
  private ?self $parent = null;

  /**
   * @var Collection<int, self>
   */
  #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
  #[Groups(['category:read'])]
  private Collection $subcategories;

  public function __construct()
  {
    $this->articles = new ArrayCollection();
    $this->subcategories = new ArrayCollection();
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
   * @return Collection<int, Article>
   */
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
}
