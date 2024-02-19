<?php

namespace App\Dto;

use App\Enum\UserStatusEnum;
use OpenApi\Attributes\Property;

class UserFilterQuery
{
    #[Property(description: 'The name of the user')]
    public ?string $name = null;

    #[Property(description: 'The status of the user')]
    public ?UserStatusEnum $status = null;

    /**
     * @var array<string>
     */
    #[Property(description: 'The roles of the user')]
    public array $roles = [];
}