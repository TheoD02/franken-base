<?php

declare(strict_types=1);

namespace App\Domain\User\Enum;

enum UserRoleEnum: string
{
    case ADMIN = 'admin';
    case USER = 'user';
    case GUEST = 'guest';
}
