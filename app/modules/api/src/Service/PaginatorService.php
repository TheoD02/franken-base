<?php

namespace Module\Api\Service;

use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use loophp\collection\CollectionDecorator;
use Module\Api\Adapter\ORMFilterQuery;

class PaginatorService
{
    public function __construct(
        private readonly PaginatorInterface $paginator
    ) {
    }

    /**
     * @param array<ORMFilterQuery|null> $filterQueryList
     * @param class-string $collectionFqcn
     */
    public function paginate(QueryBuilder $queryBuilder, string $collectionFqcn, array $filterQueryList = []): mixed
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

        return $collectionFqcn::fromIterable($this->paginator->paginate($queryBuilder)->getItems());
    }
}