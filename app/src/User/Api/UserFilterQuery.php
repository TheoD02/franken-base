<?php

declare(strict_types=1);

namespace App\User\Api;

use Doctrine\ORM\QueryBuilder;
use Module\Api\Adapter\ORMFilterQuery;
use OpenApi\Attributes\Property;
use Symfony\Component\Validator\Constraints as Assert;

class UserFilterQuery implements ORMFilterQuery
{
    #[Property(description: 'The query to search for')]
    #[Assert\Length(min: 3, max: 255)]
    public ?string $query = null;

    #[\Override]
    public function applyFilter(QueryBuilder $queryBuilder): QueryBuilder
    {
        if ($this->query) {
            $queryBuilder
                ->andWhere('entity.email LIKE :query')
                ->setParameter('query', "%{$this->query}%");
        }

        return $queryBuilder;
    }
}
