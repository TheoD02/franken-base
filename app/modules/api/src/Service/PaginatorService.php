<?php

declare(strict_types=1);

namespace Module\Api\Service;

use App\Service\AutoMapper;
use App\Service\FetcherService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Tools\Pagination\Paginator;
use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Adapter\ORMFilterQueryInterface;

class PaginatorService
{
    public function __construct(
        private readonly AutoMapper $mapper,
        private readonly FetcherService $fetcherService,
    ) {
    }

    /**
     * @template T of ApiDataCollectionInterface
     *
     * @param array<ORMFilterQueryInterface|null> $filterQueryList
     * @param class-string<T>                     $collectionFqcn
     * @param class-string|null                   $mappedClass
     *
     * @return T
     */
    public function paginate(
        QueryBuilder $queryBuilder,
        string $collectionFqcn,
        ?string $mappedClass = null,
        array $filterQueryList = [],
    ): ApiDataCollectionInterface {
        $filterQueryList = array_filter($filterQueryList);
        foreach ($filterQueryList as $filterQuery) {
            $filterQuery?->applyFilter($queryBuilder);
        }

        if (class_exists($collectionFqcn) === false) {
            throw new \InvalidArgumentException(sprintf('The collection class "%s" does not exist.', $collectionFqcn));
        }

        if (is_subclass_of($collectionFqcn, ArrayCollection::class) === false) {
            throw new \InvalidArgumentException(sprintf('The collection class "%s" must be a subclass of "%s".', $collectionFqcn, ArrayCollection::class));
        }

        $items = (new Paginator($queryBuilder))->getIterator()->getArrayCopy();

        foreach ($items as $item) {
            $this->fetcherService->fetchRemoteResourceFor($item);
        }

        if ($mappedClass !== null) {
            $items = $this->mapper->mapMultiple($items, $mappedClass);
        }

        return new $collectionFqcn($items);
    }
}
