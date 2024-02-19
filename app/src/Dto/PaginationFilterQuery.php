<?php

namespace App\Dto;

class PaginationFilterQuery
{
    public ?int $page = 1;
    public ?int $limit = 10;
}