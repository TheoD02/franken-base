<?php

namespace App\Enum;

use OpenApi\Attributes\Schema;

enum UserStatusEnum: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
}
