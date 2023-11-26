<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BookRepository::class)]
#[ORM\Index(columns: ['title'], name: 'search_idx')]
class Book
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $release_date = null;

    #[ORM\Column]
    private ?int $pages = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description = null;

    #[ORM\JoinTable(name: 'books_authors')]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'author_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Author::class)]
    private Collection $authors;

    #[ORM\JoinTable(name: 'books_tags')]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'tag_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Tag::class)]
    private Collection $tags;

    #[ORM\JoinTable(name: 'books_photos')]
    #[ORM\JoinColumn(name: 'book_id', referencedColumnName: 'id')]
    #[ORM\InverseJoinColumn(name: 'photo_id', referencedColumnName: 'id')]
    #[ORM\ManyToMany(targetEntity: Photo::class)]
    private Collection $photos;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class)]
    private Collection $reviews;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2)]
    private ?string $price = null;

    #[ORM\Column(type: Types::INTEGER)]
    private ?string $weight = null;

    #[ORM\Column(length: 100)]
    private ?string $language = null;

    #[ORM\Column(length: 100)]
    private ?string $cover = null;

    private ?float $avgRating = null;

    public function __construct()
    {
        $this->authors = new ArrayCollection();
        $this->tags = new ArrayCollection();
        $this->photos = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getAuthors(): Collection
    {
        return $this->authors;
    }

    public function addAuthor(Author $author): static
    {
        if (!$this->authors->contains($author)) {
            $this->authors->add($author);
        }

        return $this;
    }

    public function removeAuthor(Author $author): static
    {
        $this->authors->removeElement($author);

        return $this;
    }

    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): static
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
        }

        return $this;
    }

    public function getReleaseDate(): ?\DateTimeInterface
    {
        return $this->release_date;
    }

    public function setReleaseDate(?\DateTimeInterface $release_date): static
    {
        $this->release_date = $release_date;

        return $this;
    }

    public function getPages(): ?int
    {
        return $this->pages;
    }

    public function setPages(int $pages): static
    {
        $this->pages = $pages;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getTags(): Collection
    {
        return $this->tags;
    }

    public function addTag(Tag $tag): static
    {
        if (!$this->tags->contains($tag)) {
            $this->tags->add($tag);
        }

        return $this;
    }

    public function removeTag(Tag $tag): static
    {
        $this->tags->removeElement($tag);

        return $this;
    }

    public function getPhotos(): Collection
    {
        return $this->photos;
    }

    public function addPhoto(Photo $photo): static
    {
        if (!$this->photos->contains($photo)) {
            $this->photos->add($photo);
        }

        return $this;
    }

    public function removePhoto(Photo $photo): static
    {
        $this->photos->removeElement($photo);

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): static
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getWeight(): ?string
    {
        return $this->weight;
    }

    /**
     * @param string|null $weight
     */
    public function setWeight(?string $weight): void
    {
        $this->weight = $weight;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string|null $language
     */
    public function setLanguage(?string $language): void
    {
        $this->language = $language;
    }

    /**
     * @return string|null
     */
    public function getCover(): ?string
    {
        return $this->cover;
    }

    /**
     * @param string|null $cover
     */
    public function setCover(?string $cover): void
    {
        $this->cover = $cover;
    }

    public function getAvgRating(): ?float
    {
        return $this->avgRating;
    }

    public function setAvgRating(?float $avgRating): static
    {
        $this->avgRating = $avgRating;

        return $this;
    }
}
