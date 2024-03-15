<?php

namespace Module\Api\Adapter;

use Doctrine\ORM\QueryBuilder;

interface ORMFilterQuery
{
    public function applyFilter(QueryBuilder $queryBuilder): QueryBuilder;
}