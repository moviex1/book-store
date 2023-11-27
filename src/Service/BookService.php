<?php

namespace App\Service;

use App\Entity\Book;

class BookService
{
    public function processBookResults(array $bookResults, bool $single = false): Book|array
    {
        $result = [];
        foreach ($bookResults as $bookResult) {
            /**
             * @var $book Book
             */
            $book = $bookResult[0];
            $book->setAvgRating($bookResult['avg_rate']);
            $result[] = $book;
        }

        if (count($result) == 1 && $single){
            return $result[0];
        }

        return $result;
    }
}