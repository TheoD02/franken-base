<?php

declare(strict_types=1);

namespace Module\Api\Enum;

enum ApiErrorType: string
{
    case BUSINESS_ERROR = 'BUSINESS_ERROR';
    case VALIDATION_FAILED = 'VALIDATION_FAILED';
    case UNKNOWN = 'UNKNOWN';
    case NORMALIZATION_ERROR = 'NORMALIZATION_ERROR';
}
