<?php

declare(strict_types=1);

namespace App\Domain\User\Exception;

use Module\ExceptionHandlerBundle\Adapter\ApiExceptionErrorCodeInterface;
use Module\ExceptionHandlerBundle\Adapter\ApiExceptionParentCodeInterface;

enum UserExceptionEnum: string implements ApiExceptionParentCodeInterface, ApiExceptionErrorCodeInterface
{
    case USER_EXCEPTION = 'USER_EXCEPTION'; // Parent code

    // Error codes
    case PROCESSING_ERROR = 'PROCESSING_ERROR';
    case NOT_FOUND = 'NOT_FOUND';
}
