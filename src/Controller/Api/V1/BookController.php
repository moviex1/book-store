<?php

namespace App\Controller\Api\V1;

use App\Entity\Book;
use App\Repository\BookRepository;
use App\Response\BookResponse;
use FOS\RestBundle\Controller\Annotations\QueryParam;
use FOS\RestBundle\Controller\Annotations\View;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/book')]
class BookController extends AbstractController
{
    #[Route('/', name: 'app_book')]
    #[QueryParam(name: 'page', requirements: '\d+', default: '1')]
    #[QueryParam(name: 'limit', requirements: '\d+', default: '10')]
    #[QueryParam(name: 'sortBy', requirements: 'price|title|avg_rate|release_date', default: 'title')]
    #[QueryParam(name: 'sortOrder', requirements: 'asc|desc', default: 'desc')]
    #[View]
    public function index(BookRepository $bookRepository, ParamFetcher $paramFetcher): array
    {
        return $bookRepository->findBooks(
            $paramFetcher->get('page'),
            $paramFetcher->get('limit'),
            $paramFetcher->get('sortBy'),
            $paramFetcher->get('sortOrder')
        );
    }

    #[Route('/{bookId}', requirements: ['bookId' => '\d+'])]
    #[View]
    public function getBookById(int $bookId, BookRepository $bookRepository): Book|JsonResponse
    {
        $book = $bookRepository->findOneById($bookId);
        if ($book === null) {
            return $this->json([
                'message' => 'Книга с таким id не найдена'
            ], Response::HTTP_NOT_FOUND);
        }

        return $book;
    }

    #[Route('/title')]
    #[QueryParam(name: 'title', strict: true)]
    #[View]
    public function getBooksByTitle(BookRepository $bookRepository, ParamFetcher $paramFetcher): array|JsonResponse
    {
        $title = $paramFetcher->get('title');

        if (!$title) {
            return $this->json([
                'message' => 'You should pass title as query parameter'
            ], Response::HTTP_BAD_REQUEST);
        }

        $books = $bookRepository->findBooksByTitle($title);
        $result = [];
        foreach ($books as $book) {
            $result[] = new BookResponse($book);
        }

        return $result;
    }

    #[Route('/tag/{tagId}')]
    #[View]
    public function getBookByTagId(int $tagId, BookRepository $bookRepository): array
    {
        $books = $bookRepository->findBooksByTagId($tagId);
        $result = [];
        foreach ($books as $book) {
            $result[] = new BookResponse($book);
        }

        return $result;
    }

    #[Route('/author/{authorId}')]
    #[View]
    public function getBooksByAuthorId(int $authorId, BookRepository $bookRepository): array
    {
        $books = $bookRepository->findBooksByAuthorId($authorId);
        $result = [];
        foreach ($books as $book) {
            $result[] = new BookResponse($book);
        }

        return $result;
    }
}
