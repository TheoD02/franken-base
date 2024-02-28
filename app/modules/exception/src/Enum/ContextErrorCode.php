<?php

namespace Module\ExceptionHandlerBundle\Enum;

use Module\ExceptionHandlerBundle\Adapter\ApiExceptionContextCodeInterface;

enum ContextErrorCode: string implements ApiExceptionContextCodeInterface
{
    case TECHNICAL_ERROR = 'TECHNICAL_ERROR';
    case BUSINESS_ERROR = 'BUSINESS_ERROR';
    case NETWORK_ERROR = 'NETWORK_ERROR';
}