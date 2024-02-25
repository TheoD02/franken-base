<?php

declare(strict_types=1);

namespace App\User\Exception;

enum UserExceptionEnum: string
{
    case USER_EXCEPTION = 'USER_EXCEPTION';

    case PROCESSING_ERROR = 'PROCESSING_ERROR';
    case NOT_FOUND = 'NOT_FOUND';
}
