<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use App\BookStore\Application\Command\UpdateBookCommand;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\Author;
use App\BookStore\Domain\ValueObject\BookContent;
use App\BookStore\Domain\ValueObject\BookDescription;
use App\BookStore\Domain\ValueObject\BookName;
use App\BookStore\Domain\ValueObject\Price;
use App\Shared\Application\Command\CommandBusInterface;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class UpdateBookTest extends KernelTestCase
{
    public function testUpdateBook(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var CommandBusInterface $commandBus */
        $commandBus = self::getContainer()->get(CommandBusInterface::class);

        $initialBook = DummyBookFactory::createBook(name: 'name', description: 'description', author: 'author', content: 'content', price: 1000);

        $bookRepository->add($initialBook);

        $commandBus->dispatch(new UpdateBookCommand(
            $initialBook->id(),
            name: new BookName('newName'),
            content: new BookContent('newContent'),
            price: new Price(2000),
        ));

        $book = $bookRepository->ofId($initialBook->id());

        self::assertEquals(new BookName('newName'), $book->name());
        self::assertEquals(new BookDescription('description'), $book->description());
        self::assertEquals(new Author('author'), $book->author());
        self::assertEquals(new BookContent('newContent'), $book->content());
        self::assertEquals(new Price(2000), $book->price());
    }
}
