<?php

namespace App\Repository;

use App\Entity\Book;
use App\Response\BookResponse;
use App\Service\BookService;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Book>
 *
 * @method Book|null find($id, $lockMode = null, $lockVersion = null)
 * @method Book|null findOneBy(array $criteria, array $orderBy = null)
 * @method Book[]    findAll()
 * @method Book[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry, public BookService $bookService)
    {
        parent::__construct($registry, Book::class);
    }

    public function findBooks(
        int $page,
        int $limit,
        string $sortBy,
        string $sortOrder
    ): array {
        $offset = ($page - 1) * $limit;

        $booksResults = $this->booksWithAvgRateQueryBuilder()
            ->setFirstResult($offset)
            ->setMaxResults($limit)
            ->orderBy('b.' . $sortBy, $sortOrder)
            ->getQuery()
            ->getResult();

        return $this->bookService->processBookResults($booksResults);
    }

    public function findOneById(int $bookId): ?Book
    {
        $bookResult = $this->booksWithAvgRateQueryBuilder()
            ->andWhere('b.id = :bookId')
            ->groupBy('b.id')
            ->setParameter(':bookId', $bookId)
            ->getQuery()
            ->getOneOrNullResult();

        if ($bookResult === null) {
            return null;
        }

        return $this->bookService->processBookResults([$bookResult], true);
    }

    public function findBooksByTagId(int $tagId): array
    {
        return $this->booksWithAvgRateQueryBuilder()
            ->innerJoin('b.tags', 't')
            ->andWhere('t.id = :tagId')
            ->setParameter('tagId', $tagId)
            ->getQuery()
            ->getResult();
    }

    public function findBooksByTitle(string $title): array
    {
        $bookResults = $this->booksWithAvgRateQueryBuilder()
            ->andWhere('b.title LIKE :title')
            ->setParameter('title', "$title%")
            ->getQuery()
            ->getResult();
        return $this->bookService->processBookResults($bookResults);
    }

    public function findBooksByAuthorId(int $authorId): array
    {
        $bookResults = $this->booksWithAvgRateQueryBuilder()
            ->innerJoin('b.authors', 'a')
            ->andWhere('a.id = :authorId')
            ->setParameter('authorId', $authorId)
            ->getQuery()
            ->getResult();

        return $this->bookService->processBookResults($bookResults);
    }

    private function booksWithAvgRateQueryBuilder(): QueryBuilder
    {
        return $this->createQueryBuilder('b')
            ->addSelect('b', 'avg(r.rate) as avg_rate')
            ->leftJoin('b' . '.reviews', 'r')
            ->groupBy('b.id');
    }

    //    /**
    //     * @return Book[] Returns an array of Book objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('b.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Book
    //    {
    //        return $this->createQueryBuilder('b')
    //            ->andWhere('b.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
