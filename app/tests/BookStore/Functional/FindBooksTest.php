<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use App\BookStore\Application\Query\FindBooksQuery;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\Author;
use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class FindBooksTest extends KernelTestCase
{
    public function testFindBooks(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        $initialBooks = [
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
        ];

        foreach ($initialBooks as $book) {
            $bookRepository->add($book);
        }

        $books = $queryBus->ask(new FindBooksQuery());

        self::assertCount(\count($initialBooks), $books);
        foreach ($books as $book) {
            self::assertContains($book, $initialBooks);
        }
    }

    public function testFilterBooksByAuthor(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        $bookRepository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $bookRepository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $bookRepository->add(DummyBookFactory::createBook(author: 'authorTwo'));

        self::assertCount(3, $bookRepository);

        $books = $queryBus->ask(new FindBooksQuery(author: new Author('authorOne')));

        self::assertCount(2, $books);
        foreach ($books as $book) {
            self::assertEquals(new Author('authorOne'), $book->author());
        }
    }

    public function testReturnPaginatedBooks(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        $initialBooks = [
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
            DummyBookFactory::createBook(),
        ];

        foreach ($initialBooks as $book) {
            $bookRepository->add($book);
        }

        $books = $queryBus->ask(new FindBooksQuery(page: 2, itemsPerPage: 2));

        self::assertCount(2, $books);
        $i = 0;
        foreach ($books as $book) {
            self::assertSame($initialBooks[$i + 2], $book);
            ++$i;
        }
    }
}
