<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\InMemory;

use App\Shared\Domain\Repository\PaginatorInterface;
use App\Shared\Domain\Repository\RepositoryInterface;
use Webmozart\Assert\Assert;

/**
 * @template T of object
 *
 * @implements RepositoryInterface<T>
 */
abstract class AbstractInMemoryRepository implements RepositoryInterface
{
    /**
     * @var array<string, T>
     */
    protected array $entities = [];

    protected ?int $page = null;

    protected ?int $itemsPerPage = null;

    public function getIterator(): \Iterator
    {
        if (($paginator = $this->paginator()) instanceof PaginatorInterface) {
            yield from $paginator;

            return;
        }

        yield from $this->entities;
    }

    public function withPagination(int $page, int $itemsPerPage): static
    {
        Assert::positiveInteger($page);
        Assert::positiveInteger($itemsPerPage);

        $cloned = clone $this;
        $cloned->page = $page;
        $cloned->itemsPerPage = $itemsPerPage;

        return $cloned;
    }

    public function withoutPagination(): static
    {
        $cloned = clone $this;
        $cloned->page = null;
        $cloned->itemsPerPage = null;

        return $cloned;
    }

    public function paginator(): ?PaginatorInterface
    {
        if ($this->page === null || $this->itemsPerPage === null) {
            return null;
        }

        return new InMemoryPaginator(new \ArrayIterator($this->entities), \count($this->entities), $this->page, $this->itemsPerPage);
    }

    public function count(): int
    {
        if (($paginator = $this->paginator()) instanceof PaginatorInterface) {
            return \count($paginator);
        }

        return \count($this->entities);
    }

    /**
     * @param callable(mixed, mixed=): bool $filter
     */
    protected function filter(callable $filter): static
    {
        $cloned = clone $this;
        $cloned->entities = array_filter($cloned->entities, $filter);

        return $cloned;
    }
}
