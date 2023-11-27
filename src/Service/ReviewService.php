<?php

namespace App\Service;

use App\Dto\ReviewBodyDto;
use App\Entity\Review;
use App\Entity\User;
use App\Repository\BookRepository;
use App\Repository\ReviewRepository;

class ReviewService
{
    public function __construct(
        public ReviewRepository $reviewRepository,
        public BookRepository $bookRepository,
    )
    {
    }

    public function leaveReview(
        User $user,
        ReviewBodyDto $reviewDto,
    ): void
    {
        $book = $this->bookRepository->find($reviewDto->bookId);
        $this->reviewRepository->createReview($user, $book, $reviewDto);
    }
}