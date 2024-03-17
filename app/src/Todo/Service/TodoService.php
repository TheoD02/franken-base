<?php

declare(strict_types=1);

namespace App\Todo\Service;

use App\Todo\ValueObject\Todo;
use App\Todo\ValueObject\TodoCollection;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class TodoService
{
    public function __construct(
        #[Autowire(service: 'json_placeholder.client')]
        private readonly HttpClientInterface $client,
        private readonly DenormalizerInterface $normalizer
    ) {
    }

    public function getTodos(bool $lazy = false): TodoCollection
    {
        if ($lazy === true) {
            return new TodoCollection($this);
        }

        $collection = new TodoCollection($this);
        $collection->doInitialize();
        return $collection;
    }

    /**
     * @return array<Todo>
     */
    public function fetchTodos(array $identifiers): array
    {
        $query = null;
        if ($identifiers) {
            $query = http_build_query(['id' => $identifiers]);
        }

        $url = '/todos';
        if ($query) {
            $url .= '?' . $query;
        }

        $todos = $this->client->request('GET', $url)->toArray();

        return $this->normalizer->denormalize($todos, Todo::class . '[]');
    }

    public function getOneById(): Todo
    {
        $todo = $this->client->request('GET', '/todos/1')->toArray();

        return $this->normalizer->denormalize($todo, Todo::class);
    }
}
