<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use App\BookStore\Application\Command\DeleteBookCommand;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\Shared\Application\Command\CommandBusInterface;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class DeleteBookTest extends KernelTestCase
{
    public function testDeleteBook(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var CommandBusInterface $commandBus */
        $commandBus = self::getContainer()->get(CommandBusInterface::class);

        $book = DummyBookFactory::createBook();
        $bookRepository->add($book);

        self::assertCount(1, $bookRepository);

        $commandBus->dispatch(new DeleteBookCommand($book->id()));

        self::assertEmpty($bookRepository);
    }
}
