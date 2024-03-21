<?php

declare(strict_types=1);

namespace App\Tests\Shared\Unit\Infrastructure\InMemory;

use App\Shared\Infrastructure\InMemory\InMemoryPaginator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class InMemoryPaginatorTest extends TestCase
{
    #[DataProvider('provideGetLastPageCases')]
    public function testGetLastPage(int $lastPage, int $itemsPerPage): void
    {
        $items = [1, 2, 3];

        $inMemoryPaginator = new InMemoryPaginator(items: new \ArrayIterator($items), totalItems: \count($items), currentPage: 1, itemsPerPage: $itemsPerPage);

        $this->assertSame($lastPage, $inMemoryPaginator->getLastPage());
    }

    public static function provideGetLastPageCases(): iterable
    {
        yield [3, 1];
        yield [2, 2];
        yield [1, 3];
    }

    #[DataProvider('provideIteratorCases')]
    public function testIterator(int $currentPage, int $itemsPerPage, array $page): void
    {
        $items = [1, 2, 3];

        $inMemoryPaginator = new InMemoryPaginator(
            items: new \ArrayIterator($items),
            totalItems: \count($items),
            currentPage: $currentPage,
            itemsPerPage: $itemsPerPage,
        );

        $this->assertCount(\count($page), $inMemoryPaginator);

        $i = 0;
        foreach ($inMemoryPaginator as $item) {
            $this->assertSame($page[$i], $item);
            ++$i;
        }
    }

    public static function provideIteratorCases(): iterable
    {
        yield [1, 3, [1, 2, 3]];
        yield [2, 3, []];
        yield [2, 2, [3]];
        yield [1, 1, [1]];
        yield [2, 1, [2]];
        yield [3, 1, [3]];
        yield [4, 1, []];
    }
}
