<?php

declare(strict_types=1);

namespace Module\ExceptionHandlerBundle\Enum;

use Module\ExceptionHandlerBundle\Adapter\ApiExceptionContextCodeInterface;

enum ContextErrorCodeEnum: string implements ApiExceptionContextCodeInterface
{
    case TECHNICAL_ERROR = 'TECHNICAL_ERROR';
    case BUSINESS_ERROR = 'BUSINESS_ERROR';
    case NETWORK_ERROR = 'NETWORK_ERROR';
}
