<?php

namespace App\Entity;

use App\Repository\UserReviewsRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserReviewsRepository::class)]
class UserReviews
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $book_id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $book_title = null;

    #[ORM\Column(nullable: true)]
    private ?int $review_vote = null;

    #[ORM\Column(type: "text", nullable: true)]
    private ?string $review_description = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookId(): ?int
    {
        return $this->book_id;
    }

    public function setBookId(int $book_id): static
    {
        $this->book_id = $book_id;

        return $this;
    }

    public function getBookTitle(): ?string
    {
        return $this->book_title;
    }

    public function setBookTitle(?string $book_title): static
    {
        $this->book_title = $book_title;

        return $this;
    }

    public function getReviewVote(): ?int
    {
        return $this->review_vote;
    }

    public function setReviewVote(?int $review_vote): static
    {
        $this->review_vote = $review_vote;

        return $this;
    }

    public function getReviewDescription(): ?string
    {
        return $this->review_description;
    }

    public function setReviewDescription(?string $review_description): static
    {
        $this->review_description = $review_description;

        return $this;
    }

    
}
