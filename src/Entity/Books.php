<?php

namespace App\Entity;

use App\Entity\Review;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BooksRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


#[ORM\Entity(repositoryClass: BooksRepository::class)]

#[ApiResource(
    normalizationContext : ['groups' => ['read:collection']],
    paginationItemsPerPage : 1,
    itemOperations : [
        'put'=> [
            'denormalization_context' => ['groups' =>['put:book']]
        ],
        'delete',
        'get' => [
            'normalization_context' => ['groups' =>['read:collection']]
        ],
        // 'post'=> [
        //     'denormalization_context' => ['groups' =>['read:collection','read:item']]
        // ]
    ]
        ) 
]
#[ApiFilter(SearchFilter::class, properties: ['id' => 'exact'])]
class Books
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:collection','put:book'])]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:collection'])]
    private ?string $description = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    #[Groups(['read:item'])]
    private ?\DateTimeInterface $dateP = null;

    #[ORM\Column(length: 255)]
    #[Groups(['read:item'])]
    private ?string $genre = null;

    #[ORM\ManyToOne(inversedBy: 'Books')]
    private ?Author $author = null;

    #[ORM\OneToMany(mappedBy: 'book', targetEntity: Review::class)]
    private Collection $reviews;

    public function __construct()
    {
        $this->reviews = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getDateP(): ?\DateTimeInterface
    {
        return $this->dateP;
    }

    public function setDateP(\DateTimeInterface $dateP): self
    {
        $this->dateP = $dateP;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(string $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuthor(): ?Author
    {
        return $this->author;
    }

    public function setAuthor(?Author $author): self
    {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Collection<int, Review>
     */
    public function getReviews(): Collection
    {
        return $this->reviews;
    }

    public function addReview(Review $review): self
    {
        if (!$this->reviews->contains($review)) {
            $this->reviews->add($review);
            $review->setBook($this);
        }

        return $this;
    }

    public function removeReview(Review $review): self
    {
        if ($this->reviews->removeElement($review)) {
            // set the owning side to null (unless already changed)
            if ($review->getBook() === $this) {
                $review->setBook(null);
            }
        }

        return $this;
    }
}
