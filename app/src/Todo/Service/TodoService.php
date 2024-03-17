<?php

declare(strict_types=1);

namespace App\Todo\Service;

use App\Todo\Client\Endpoint\Todos\TodoFilterQuery;
use App\Todo\Client\JsonPlaceholderClient;
use App\Todo\ValueObject\Todo;
use App\Todo\ValueObject\TodoCollection;

class TodoService
{
    public function __construct(
        private readonly JsonPlaceholderClient $client,
    ) {
    }

    /**
     * @return TodoCollection<array-key, Todo>
     */
    public function getTodos(?TodoFilterQuery $todoFilterQuery = null): TodoCollection
    {
        $todoFilterQuery = $todoFilterQuery ?? new TodoFilterQuery();

        $todos = $this->client->getTodos($todoFilterQuery);

        return new TodoCollection($todos);
    }

    public function getOneById(int $id): Todo
    {
        return $this->client->getOneById($id);
    }
}
