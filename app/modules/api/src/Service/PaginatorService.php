<?php

declare(strict_types=1);

namespace Module\Api\Service;

use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use loophp\collection\CollectionDecorator;
use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Adapter\ORMFilterQueryInterface;

class PaginatorService
{
    public function __construct(
        private readonly PaginatorInterface $paginator
    ) {
    }

    /**
     * @template T of ApiDataCollectionInterface
     *
     * @param array<ORMFilterQueryInterface|null> $filterQueryList
     * @param class-string<T>                     $collectionFqcn
     *
     * @return T
     */
    public function paginate(QueryBuilder $queryBuilder, string $collectionFqcn, array $filterQueryList = []): ApiDataCollectionInterface
    {
        foreach ($filterQueryList as $filterQuery) {
            $filterQuery?->applyFilter($queryBuilder);
        }

        if (class_exists($collectionFqcn) === false) {
            throw new \InvalidArgumentException(sprintf('The collection class "%s" does not exist.', $collectionFqcn));
        }

        if (is_subclass_of($collectionFqcn, CollectionDecorator::class) === false) {
            throw new \InvalidArgumentException(sprintf('The collection class "%s" must be a subclass of "%s".', $collectionFqcn, CollectionDecorator::class));
        }

        $items = $this->paginator->paginate($queryBuilder)->getItems();

        return $collectionFqcn::fromIterable($items);
    }
}
