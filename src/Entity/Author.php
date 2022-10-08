<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\AuthorRepository;
// use ApiPlatform\Metadata\ApiResource;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Metadata\ApiFilter;
// use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;


#[ORM\Entity(repositoryClass: AuthorRepository::class)]

#[ApiResource()]
#[ApiFilter(SearchFilter::class, properties: ['firstName' => 'exact'])]
class Author
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $firstName = null;

    #[ORM\Column(length: 255)]
    private ?string $lastName = null;

    #[ORM\Column(length: 255)]
    private ?string $bibliography = null;

    #[ORM\OneToMany(mappedBy: 'author', targetEntity: Books::class)]
    private Collection $books;

    public function __construct()
    {
        $this->books = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBibliography(): ?string
    {
        return $this->bibliography;
    }

    public function setBibliography(string $bibliography): self
    {
        $this->bibliography = $bibliography;

        return $this;
    }

    /**
     * @return Collection<int, books>
     */
    public function getBooks(): Collection
    {
        return $this->books;
    }

    public function addBook(books $book): self
    {
        if (!$this->books->contains($book)) {
            $this->books->add($book);
            $book->setAuthor($this);
        }

        return $this;
    }

    public function removeBook(books $book): self
    {
        if ($this->books->removeElement($book)) {
            // set the owning side to null (unless already changed)
            if ($book->getAuthor() === $this) {
                $book->setAuthor(null);
            }
        }

        return $this;
    }
}
