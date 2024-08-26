<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(

    normalizationContext: ['groups' => ['articles:list:read', 'articles:item:read', 'articles:item:write']],
    denormalizationContext: ['groups' => ['articles:list::write', 'articles:item:read']],

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
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['articles:list:read', 'articles:item:read'])]
    private ?int $id = null;


    #[Groups(['articles:list:read', 'articles:item:read', 'articles:item:write'])]
    #[ORM\Column(length: 50)]
    private ?string $name = null;
    /*
      #[ORM\ManyToOne]
      #[ORM\JoinColumn(nullable: false)]
      private ?Category $category = null;
    */
    #[Groups(['articles:list:read', 'articles:item:read'])]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $urlimage = null;


    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['articles:list:read', 'category:read'])]
    private ?Category $category = null;


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

    public function getUrlimage(): ?string
    {
        return $this->urlimage;
    }

    public function setUrlimage(?string $urlimage): static
    {
        $this->urlimage = $urlimage;

        return $this;
    }


    public function getCategory(): ?category
    {
        return $this->category;
    }

    public function setCategory(?category $category): static
    {
        $this->category = $category;

        return $this;
    }

}
