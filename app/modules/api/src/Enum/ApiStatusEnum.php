<?php

declare(strict_types=1);

namespace Module\Api\Enum;

enum ApiStatusEnum: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
}
