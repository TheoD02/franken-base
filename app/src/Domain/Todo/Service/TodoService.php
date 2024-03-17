<?php

declare(strict_types=1);

namespace App\Domain\Todo\Service;

use App\Domain\Todo\Client\Endpoint\Todos\TodoFilterQuery;
use App\Domain\Todo\Client\JsonPlaceholderClient;
use App\Domain\Todo\ValueObject\Todo;
use App\Domain\Todo\ValueObject\TodoCollection;

class TodoService
{
    public function __construct(
        private readonly JsonPlaceholderClient $client,
    ) {
    }

    /**
     * @return TodoCollection<int, Todo>
     */
    public function getTodos(?TodoFilterQuery $todoFilterQuery = null): TodoCollection
    {
        $todoFilterQuery = $todoFilterQuery ?? new TodoFilterQuery();

        $todos = $this->client->getTodos($todoFilterQuery);

        return TodoCollection::fromArray($todos);
    }

    public function getOneById(int $id): Todo
    {
        return $this->client->getOneById($id);
    }
}
