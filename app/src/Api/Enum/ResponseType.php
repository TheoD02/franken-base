<?php

namespace App\Api\Enum;

use function enum;

enum ResponseType
{
    case ITEM;
    case COLLECTION;
}