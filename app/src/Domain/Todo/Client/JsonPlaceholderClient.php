<?php

declare(strict_types=1);

namespace App\Domain\Todo\Client;

use App\Domain\Todo\Client\Endpoint\Todos\TodoFilterQuery;
use App\Domain\Todo\ValueObject\Todo;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class JsonPlaceholderClient
{
    public function __construct(
        #[Autowire(service: 'json_placeholder.client')]
        private readonly HttpClientInterface $client,
        private readonly DenormalizerInterface $denormalizer,
    ) {
    }

    /**
     * @return array<Todo>
     */
    public function getTodos(?TodoFilterQuery $todoFilterQuery = null): array
    {
        $query = $todoFilterQuery?->buildQuery() ?? '';

        $url = '/todos';
        if ($query !== '' && $query !== '0') {
            $url .= '?' . $query;
        }

        $response = $this->client->request('GET', $url);

        return $this->denormalizer->denormalize($response->toArray(), Todo::class . '[]');
    }

    public function getOneById(int $id): Todo
    {
        $response = $this->client->request('GET', '/todos/' . $id)->toArray();

        return $this->denormalizer->denormalize($response, Todo::class);
    }
}
