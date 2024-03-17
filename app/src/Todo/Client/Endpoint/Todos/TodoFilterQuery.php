<?php

declare(strict_types=1);

namespace App\Todo\Client\Endpoint\Todos;

use Symfony\Component\Validator\Constraints as Assert;

class TodoFilterQuery
{
    /**
     * @var array<int> $identifiers
     */
    #[Assert\All([new Assert\Positive()])]
    #[Assert\Count(min: 1)]
    public array $identifiers;

    /**
     * @var array<int> $userIdentifiers
     */
    #[Assert\All([new Assert\Positive()])]
    #[Assert\Count(min: 1)]
    public array $userIdentifiers;

    private function toArray(): array
    {
        $query = [];

        if (isset($this->identifiers)) {
            $query['id'] = $this->identifiers;
        }

        if (isset($this->userIdentifiers)) {
            $query['userId'] = $this->userIdentifiers;
        }

        return $query;
    }

    public function buildQuery(): string
    {
        return http_build_query($this->toArray());
    }
}
