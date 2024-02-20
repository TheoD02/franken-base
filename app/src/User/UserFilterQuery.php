<?php

namespace App\User;

use OpenApi\Attributes\Property;

readonly class UserFilterQuery
{
    #[Property(description: 'The query to search for')]
    public ?string $query;
}