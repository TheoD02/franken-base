<?php

namespace Module\Api\Enum;

enum ContextErrorCode: string
{
    case TECHNICAL_ERROR = 'TECHNICAL_ERROR';
    case BUSINESS_ERROR = 'BUSINESS_ERROR';
    case NETWORK_ERROR = 'NETWORK_ERROR';
}