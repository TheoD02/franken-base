<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use App\BookStore\Application\Query\FindCheapestBooksQuery;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\Price;
use App\Shared\Application\Query\QueryBusInterface;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class FindCheapestBooksTest extends KernelTestCase
{
    public function testReturnOnlyTheCheapestBooks(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        for ($i = 0; $i < 5; ++$i) {
            $bookRepository->add(DummyBookFactory::createBook());
        }

        $cheapestBooks = $queryBus->ask(new FindCheapestBooksQuery(3));

        $this->assertCount(3, $cheapestBooks);
    }

    public function testReturnBooksSortedByPrice(): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var QueryBusInterface $queryBus */
        $queryBus = self::getContainer()->get(QueryBusInterface::class);

        $prices = [2000, 1000, 3000];
        foreach ($prices as $price) {
            $bookRepository->add(DummyBookFactory::createBook(price: $price));
        }

        $cheapestBooks = $queryBus->ask(new FindCheapestBooksQuery(3));

        $sortedPrices = [1000, 2000, 3000];

        $i = 0;
        foreach ($cheapestBooks as $cheapestBook) {
            $this->assertEquals(new Price($sortedPrices[$i]), $cheapestBook->price());
            ++$i;
        }
    }
}
