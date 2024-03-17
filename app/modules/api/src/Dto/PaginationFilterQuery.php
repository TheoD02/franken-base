<?php

declare(strict_types=1);

namespace Module\Api\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class PaginationFilterQuery
{
    public function __construct(
        #[Assert\GreaterThan(0)]
        public int $page = 1,
        #[Assert\GreaterThan(0)]
        public int $limit = 10,
    ) {
    }
}
