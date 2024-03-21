<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use App\BookStore\Application\Command\CreateBookCommand;
use App\BookStore\Domain\Model\Book;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Domain\ValueObject\BookContent;
use App\BookStore\Domain\ValueObject\BookDescription;
use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Price;
use App\Shared\Application\Command\CommandBusInterface;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class CreateBookTest extends KernelTestCase
{
    public function testCreateBook(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var CommandBusInterface $commandBus */
        $commandBus = self::getContainer()->get(CommandBusInterface::class);

        self::assertEmpty($bookRepository);

        $commandBus->dispatch(new CreateBookCommand(
            new BookName('name'),
            new BookDescription('description'),
            new Author('author'),
            new BookContent('content'),
            new Price(1000),
        ));

        self::assertCount(1, $bookRepository);

        /** @var Book $book */
        $book = array_values(iterator_to_array($bookRepository))[0];

        self::assertEquals(new BookName('name'), $book->name());
        self::assertEquals(new BookDescription('description'), $book->description());
        self::assertEquals(new Author('author'), $book->author());
        self::assertEquals(new BookContent('content'), $book->content());
        self::assertEquals(new Price(1000), $book->price());
    }
}
