<?php

namespace App\User\Infrastructure\ApiPlatform\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\Pagination;
use ApiPlatform\State\ProviderInterface;
use App\Shared\Application\Query\QueryBusInterface;
use App\Shared\Infrastructure\ApiPlatform\State\Paginator;
use App\User\Application\Query\FindUsersQuery;
use App\User\Infrastructure\ApiPlatform\Resource\UserResource;


/**
 * @implements ProviderInterface<UserResource>
 */
final readonly class UserCollectionProvider implements ProviderInterface
{
    public function __construct(
        private QueryBusInterface $queryBus,
        private Pagination $pagination,
    ) {
    }

    /**
     * @return Paginator<UserResource>|list<UserResource>
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): Paginator|array
    {
        $offset = null;
        $limit = null;

        if ($this->pagination->isEnabled($operation, $context)) {
            $offset = $this->pagination->getPage($context);
            $limit = $this->pagination->getLimit($operation, $context);
        }

        $models = $this->queryBus->ask(new FindUsersQuery($offset, $limit));

        $resources = [];
        foreach ($models as $model) {
            $resources[] = UserResource::fromModel($model);
        }

        if (null !== $paginator = $models->paginator()) {
            return new Paginator(
                items: new \ArrayIterator($resources),
                currentPage: (float)$paginator->getCurrentPage(),
                itemsPerPage: (float)$paginator->getItemsPerPage(),
                lastPage: (float)$paginator->getLastPage(),
                totalItems: (float)$paginator->getTotalItems(),
            );
        }

        return $resources;
    }
}
