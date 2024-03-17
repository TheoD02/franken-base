<?php

declare(strict_types=1);

namespace Module\Api\Service;

use App\Service\AutoMapper;
use App\Service\FetcherService;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\QueryBuilder;
use Knp\Component\Pager\PaginatorInterface;
use Module\Api\Adapter\ApiDataCollectionInterface;
use Module\Api\Adapter\ORMFilterQueryInterface;

class PaginatorService
{
    public function __construct(
        private readonly PaginatorInterface $paginator,
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
        array $filterQueryList = []
    ): ApiDataCollectionInterface {
        foreach ($filterQueryList as $filterQuery) {
            $filterQuery?->applyFilter($queryBuilder);
        }

        if (class_exists($collectionFqcn) === false) {
            throw new \InvalidArgumentException(sprintf('The collection class "%s" does not exist.', $collectionFqcn));
        }

        if (is_subclass_of($collectionFqcn, ArrayCollection::class) === false) {
            throw new \InvalidArgumentException(sprintf('The collection class "%s" must be a subclass of "%s".', $collectionFqcn, ArrayCollection::class));
        }

        $items = $this->paginator->paginate($queryBuilder)->getItems();

        foreach ($items as $item) {
            $this->fetcherService->fetchRemoteResourceFor($item);
        }

        if ($mappedClass !== null) {
            $items = $this->mapper->mapMultiple($items, $mappedClass);
        }

        return new $collectionFqcn($items);
    }
}
