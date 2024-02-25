<?php

declare(strict_types=1);

namespace Module\Api\Enum;

enum ResponseType
{
    /**
     * The response is a single item.
     */
    case ITEM;

    /**
     * The response is a collection of items.
     */
    case COLLECTION;
}
