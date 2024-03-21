<?php

declare(strict_types=1);

namespace App\BookStore\Infrastructure\ApiPlatform\State\Provider;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\BookStore\Application\Query\FindCheapestBooksQuery;
use App\BookStore\Infrastructure\ApiPlatform\Resource\BookResource;
use App\Shared\Application\Query\QueryBusInterface;

/**
 * @implements ProviderInterface<BookResource>
 */
final readonly class CheapestBooksProvider implements ProviderInterface
{
    public function __construct(
        private QueryBusInterface $queryBus
    ) {
    }

    /**
     * @return list<BookResource>
     */
    public function provide(Operation $operation, array $uriVariables = [], array $context = []): array
    {
        $bookRepository = $this->queryBus->ask(new FindCheapestBooksQuery());

        $resources = [];
        foreach ($bookRepository as $model) {
            $resources[] = BookResource::fromModel($model);
        }

        return $resources;
    }
}
