<?php

namespace App\User\Exception;

enum UserExceptionEnum: string
{
    case GENERIC = 'GENERIC';

    case USER_PROCESSING_ERROR = 'USER_PROCESSING_ERROR';
}