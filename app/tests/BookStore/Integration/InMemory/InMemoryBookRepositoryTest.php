<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Integration\InMemory;

use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Infrastructure\InMemory\AbstractInMemoryBookRepository;
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
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);

        $this->assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->add($book);

        $this->assertCount(1, $repository);
    }

    public function testRemove(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);

        $book = DummyBookFactory::createBook();
        $repository->add($book);

        $this->assertCount(1, $repository);

        $repository->remove($book);
        $this->assertEmpty($repository);
    }

    public function testOfId(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);

        $this->assertEmpty($repository);

        $book = DummyBookFactory::createBook();
        $repository->add($book);

        $this->assertSame($book, $repository->ofId($book->id()));
    }

    public function testWithAuthor(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);

        $repository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $repository->add(DummyBookFactory::createBook(author: 'authorOne'));
        $repository->add(DummyBookFactory::createBook(author: 'authorTwo'));

        $this->assertCount(2, $repository->withAuthor(new Author('authorOne')));
        $this->assertCount(1, $repository->withAuthor(new Author('authorTwo')));
    }

    public function testWithCheapestsFirst(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);

        $repository->add(DummyBookFactory::createBook(price: 1));
        $repository->add(DummyBookFactory::createBook(price: 3));
        $repository->add(DummyBookFactory::createBook(price: 2));

        $prices = [];
        foreach ($repository->withCheapestsFirst() as $inMemoryBookRepository) {
            $prices[] = $inMemoryBookRepository->price()->amount;
        }

        $this->assertSame([1, 2, 3], $prices);
    }

    public function testWithPagination(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);
        $this->assertNull($repository->paginator());

        $repository = $repository->withPagination(1, 2);

        $this->assertInstanceOf(InMemoryPaginator::class, $repository->paginator());
    }

    public function testWithoutPagination(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);
        $repository = $repository->withPagination(1, 2);
        $this->assertNotNull($repository->paginator());

        $repository = $repository->withoutPagination();
        $this->assertNull($repository->paginator());
    }

    public function testIteratorWithoutPagination(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);
        $this->assertNull($repository->paginator());

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }

        $i = 0;
        foreach ($repository as $book) {
            $this->assertSame($books[$i], $book);
            ++$i;
        }
    }

    public function testIteratorWithPagination(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);
        $this->assertNull($repository->paginator());

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }

        $repository = $repository->withPagination(1, 2);

        $i = 0;
        foreach ($repository as $book) {
            $this->assertSame($books[$i], $book);
            ++$i;
        }

        $this->assertSame(2, $i);

        $repository = $repository->withPagination(2, 2);

        $i = 0;
        foreach ($repository as $book) {
            $this->assertSame($books[$i + 2], $book);
            ++$i;
        }

        $this->assertSame(1, $i);
    }

    public function testCount(): void
    {
        /** @var AbstractInMemoryBookRepository $repository */
        $repository = self::getContainer()->get(AbstractInMemoryBookRepository::class);

        $books = [DummyBookFactory::createBook(), DummyBookFactory::createBook(), DummyBookFactory::createBook()];
        foreach ($books as $book) {
            $repository->add($book);
        }

        $this->assertCount(\count($books), $repository);
        $this->assertCount(2, $repository->withPagination(1, 2));
    }
}
