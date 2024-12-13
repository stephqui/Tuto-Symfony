<?php
//On retrouve ici les attributs, qui permettent à l'ORM (Object Relationnal Mapping)
//de comprendre comment les données seront sauvegardées dans la BDD

namespace App\Entity;

use App\Repository\RecipeRepository;
use App\Validator\BanWord;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: RecipeRepository::class)]
#[UniqueEntity('title')]
#[UniqueEntity('slug')]
#[Vich\Uploadable()] // Cette classe pourra être uploadée
class Recipe
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['recipes.index'])]
    private ?int $id = null;

    #[ORM\Column(length: 80)]
    #[Assert\Length(min: 5, groups: ['Extra'])]
    #[BanWord(groups: ['Extra'])]
    #[Groups(['recipes.index', 'recipes.cerate'])]
    private string $title = '';

    #[ORM\Column(length: 80)]
    #[Assert\Length(min: 5)]
    #[Assert\Regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/', message: "Ce slug n'est pas au bon format")]
    #[Groups(['recipes.index', 'recipes.cerate'])]
    private string $slug = '';

    #[ORM\Column(type: Types::TEXT)]
    #[Assert\Length(min: 50)]
    #[Groups(['recipes.show', 'recipes.cerate'])]
    private string $content = '';

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    #[ORM\Column(nullable: true)]
    #[Assert\Positive()]
    #[Assert\LessThan(value: 240)]
    #[Groups(['recipes.index', 'recipes.cerate'])]
    private ?int $duration = null;

    #[ORM\ManyToOne(inversedBy: 'recipes', cascade: ['persist'])]
    #[Groups(['recipes.show'])]
    private ?Category $category = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $thumbnail = null;

    //Sert à gérer les images: ajout, remplacement, suppression...etc..
    //On utilise le bundle Vich. Le mapping vient du fichier vich_uploader
    //Cela permet de nous focaliser sur les données et non pas sur l'aspect logique de
    //suppression, modif...etc...
    //fileNameProperty: lorsqu'il sauvegarde le fichier, il récupère les infos du fichier (la)
    //version renommée) et on dit dans quelle propriété il va devoir sauver le nom du fichier (ici "thumbnail")
    #[Vich\UploadableField(mapping: 'recipes', fileNameProperty: 'thumbnail')]
    #[Assert\Image()]
    private ?File $thumbnailFile = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): static
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDuration(): ?int
    {
        return $this->duration;
    }

    public function setDuration(?int $duration): static
    {
        $this->duration = $duration;
        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getThumbnail(): ?string
    {
        return $this->thumbnail;
    }

    public function setThumbnail(?string $thumbnail): static
    {
        $this->thumbnail = $thumbnail;

        return $this;
    }
    public function getThumbnailFile(): ?File
    {
        return $this->thumbnailFile;
    }
    public function setThumbnailFile($thumbnailFile): static
    {
        $this->thumbnailFile = $thumbnailFile;
        return $this;
    }
}
