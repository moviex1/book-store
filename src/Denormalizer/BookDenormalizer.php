<?php

namespace App\Denormalizer;

use App\Entity\Book;
use App\Response\BookResponse;
use Symfony\Component\Serializer\Exception\BadMethodCallException;
use Symfony\Component\Serializer\Exception\ExceptionInterface;
use Symfony\Component\Serializer\Exception\ExtraAttributesException;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Exception\RuntimeException;
use Symfony\Component\Serializer\Exception\UnexpectedValueException;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;

class BookDenormalizer implements DenormalizerInterface
{

    public function denormalize(mixed $data, string $type, string $format = null, array $context = [])
    {
        $result = [];
        foreach ($data as $bookResult) {
            $book = $bookResult[0];
            /**
             * @var Book $book
             */
            $book->setAvgRating($bookResult['avg_rate']);
            $result[] = $book;
        }

        if ($context['single']) {
            return $result[0] ?? null;
        }

        return $result;
    }

    public function supportsDenormalization(mixed $data, string $type, string $format = null)
    {
        return true;
    }
}