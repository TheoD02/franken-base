<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use App\BookStore\Application\Query\FindBookQuery;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class FindBookTest extends KernelTestCase
{
    public function testFindBook(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        $book = DummyBookFactory::createBook();
        $bookRepository->add($book);

        self::assertSame($book, $queryBus->ask(new FindBookQuery($book->id())));
    }
}
