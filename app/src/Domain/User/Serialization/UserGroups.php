<?php

declare(strict_types=1);

namespace App\Domain\User\Serialization;

enum UserGroups
{
    public const string READ = 'user:read';

    public const string READ_ROLES = 'user:read:roles';
}
