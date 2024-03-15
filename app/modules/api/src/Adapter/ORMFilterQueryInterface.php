<?php

declare(strict_types=1);

namespace Module\Api\Adapter;

use Doctrine\ORM\QueryBuilder;

interface ORMFilterQueryInterface
{
    public function applyFilter(QueryBuilder $queryBuilder): QueryBuilder;
}
