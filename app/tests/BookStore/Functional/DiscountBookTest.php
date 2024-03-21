<?php

declare(strict_types=1);

namespace App\Tests\BookStore\Functional;

use App\BookStore\Application\Command\DiscountBookCommand;
use App\BookStore\Domain\Repository\BookRepositoryInterface;
use App\BookStore\Domain\ValueObject\Discount;
use App\BookStore\Domain\ValueObject\Price;
use App\Shared\Application\Command\CommandBusInterface;
use App\Tests\BookStore\DummyFactory\DummyBookFactory;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * @internal
 */
final class DiscountBookTest extends KernelTestCase
{
    /**
     * @dataProvider provideApplyADiscountOnBookCases
     */
    public function testApplyADiscountOnBook(int $initialAmount, int $discount, int $expectedAmount): void
    {
        /** @var BookRepositoryInterface $bookRepository */
        $bookRepository = self::getContainer()->get(BookRepositoryInterface::class);

        /** @var CommandBusInterface $commandBus */
        $commandBus = self::getContainer()->get(CommandBusInterface::class);

        $book = DummyBookFactory::createBook(price: $initialAmount);
        $bookRepository->add($book);

        $commandBus->dispatch(new DiscountBookCommand($book->id(), new Discount($discount)));

        self::assertEquals(new Price($expectedAmount), $bookRepository->ofId($book->id())->price());
    }

    public static function provideApplyADiscountOnBookCases(): iterable
    {
        yield [100, 0, 100];
        yield [100, 20, 80];
        yield [50, 30, 35];
        yield [50, 100, 0];
    }
}
