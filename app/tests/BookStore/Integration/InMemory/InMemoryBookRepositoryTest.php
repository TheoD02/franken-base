<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Integration\InMemory;

use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Infrastructure\InMemory\InMemoryBookRepository;
use App\Shared\Infrastructure\InMemory\InMemoryPaginator;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class InMemoryBookRepositoryTest extends KernelTestCase
{
    public function testAdd(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);

        self::assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->add($book);

        self::assertCount(1, $repository);
    }

    public function testRemove(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);

        $book = DummyBookFactory::createBook();
        $repository->add($book);

        self::assertCount(1, $repository);

        $repository->remove($book);
        self::assertEmpty($repository);
    }

    public function testOfId(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);

        self::assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->add($book);

        self::assertSame($book, $repository->ofId($book->id()));
    }

    public function testWithAuthor(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);

        $repository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $repository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $repository->add(DummyBookFactory::createBook(author: 'authorTwo'));

        self::assertCount(2, $repository->withAuthor(new Author('authorOne')));
        self::assertCount(1, $repository->withAuthor(new Author('authorTwo')));
    }

    public function testWithCheapestsFirst(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);

        $repository->add(DummyBookFactory::createBook(price: 1));
        $repository->add(DummyBookFactory::createBook(price: 3));
        $repository->add(DummyBookFactory::createBook(price: 2));

        $prices = [];
        foreach ($repository->withCheapestsFirst() as $book) {
            $prices[] = $book->price()->amount;
        }
        self::assertSame([1, 2, 3], $prices);
    }

    public function testWithPagination(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);
        self::assertNull($repository->paginator());

        $repository = $repository->withPagination(1, 2);

        self::assertInstanceOf(InMemoryPaginator::class, $repository->paginator());
    }

    public function testWithoutPagination(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);
        $repository = $repository->withPagination(1, 2);
        self::assertNotNull($repository->paginator());

        $repository = $repository->withoutPagination();
        self::assertNull($repository->paginator());
    }

    public function testIteratorWithoutPagination(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);
        self::assertNull($repository->paginator());

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }

        $i = 0;
        foreach ($repository as $book) {
            self::assertSame($books[$i], $book);
            ++$i;
        }
    }

    public function testIteratorWithPagination(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);
        self::assertNull($repository->paginator());

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }

        $repository = $repository->withPagination(1, 2);

        $i = 0;
        foreach ($repository as $book) {
            self::assertSame($books[$i], $book);
            ++$i;
        }

        self::assertSame(2, $i);

        $repository = $repository->withPagination(2, 2);

        $i = 0;
        foreach ($repository as $book) {
            self::assertSame($books[$i + 2], $book);
            ++$i;
        }

        self::assertSame(1, $i);
    }

    public function testCount(): void
    {
        /** @var InMemoryBookRepository $repository */
        $repository = self::getContainer()->get(InMemoryBookRepository::class);

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }

        self::assertCount(\count($books), $repository);
        self::assertCount(2, $repository->withPagination(1, 2));
    }
}
