<?php

declare(strict_types=1);

namespace App\User;

enum UserGroups
{
    public const string READ = 'user:read';

    public const string READ_ROLES = 'user:read:roles';
}
