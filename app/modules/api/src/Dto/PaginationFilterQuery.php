<?php

declare(strict_types=1);

namespace Module\Api\Dto;

use Doctrine\ORM\QueryBuilder;
use Module\Api\Adapter\ORMFilterQueryInterface;
use Symfony\Component\Validator\Constraints as Assert;

class PaginationFilterQuery implements ORMFilterQueryInterface
{
    public function __construct(
        #[Assert\GreaterThan(0)]
        public int $page = 1,
        #[Assert\GreaterThan(0)]
        public int $limit = 20,
    ) {
    }

    #[\Override]
    public function applyFilter(QueryBuilder $queryBuilder): QueryBuilder
    {
        $queryBuilder
            ->setFirstResult(($this->page - 1) * $this->limit)
            ->setMaxResults($this->limit)
        ;

        return $queryBuilder;
    }
}
