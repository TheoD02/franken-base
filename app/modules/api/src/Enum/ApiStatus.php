<?php

declare(strict_types=1);

namespace Module\Api\Enum;

enum ApiStatus: string
{
    case SUCCESS = 'success';
    case ERROR = 'error';
}
