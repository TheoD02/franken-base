<?php

namespace Module\Api\Enum;

enum ApiSecurityScopeEnum: string
{
    case USER_READ = 'user-management.read';

    case USER_WRITE = 'user-management.write';

    case USER_DELETE = 'user-management.delete';
}