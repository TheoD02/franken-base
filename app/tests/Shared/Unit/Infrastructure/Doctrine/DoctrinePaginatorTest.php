<?php

declare(strict_types=1);

namespace App\Tests\Shared\Unit\Infrastructure\Doctrine;

use App\Shared\Infrastructure\Doctrine\DoctrinePaginator;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Tools\Pagination\Paginator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\MockObject\Stub;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class DoctrinePaginatorTest extends TestCase
{
    #[DataProvider('provideGetCurrentPageCases')]
    public function testGetCurrentPage(int $currentPage, int $firstResult, int $maxResults, int $totalItems): void
    {
        $doctrinePaginator = new DoctrinePaginator($this->createPaginatorStub($firstResult, $maxResults, $totalItems));
        $this->assertSame($currentPage, $doctrinePaginator->getCurrentPage());
    }

    public static function provideGetCurrentPageCases(): iterable
    {
        yield [1, 0, 1, 3];
        yield [2, 1, 1, 3];
        yield [1, 1, 2, 3];
        yield [3, 2, 1, 3];
        yield [1, 1, -1, 3];
    }

    #[DataProvider('provideGetLastPageCases')]
    public function testGetLastPage(int $lastPage, int $maxResults, int $totalItems): void
    {
        $doctrinePaginator = new DoctrinePaginator($this->createPaginatorStub(1, $maxResults, $totalItems));
        $this->assertSame($lastPage, $doctrinePaginator->getLastPage());
    }

    public static function provideGetLastPageCases(): iterable
    {
        yield [3, 1, 3];
        yield [2, 2, 3];
        yield [1, 3, 3];
        yield [1, 4, 4];
        yield [2, 2, 4];
        yield [1, -1, 3];
    }

    private function createPaginatorStub(int $firstResult, int $maxResults, int $totalItems): Stub&Paginator
    {
        $em = $this->createStub(EntityManagerInterface::class);
        $em->method('getConfiguration')->willReturn($this->createStub(Configuration::class));

        $query = new Query($em);
        $query->setFirstResult($firstResult);
        $query->setMaxResults($maxResults);

        $paginator = $this->createStub(Paginator::class);
        $paginator->method('getQuery')->willReturn($query);
        $paginator->method('count')->willReturn($totalItems);

        return $paginator;
    }
}
