<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerated for values for itemListOrder for indicating how an ordered ItemList is organized.
 *
 * @see https://schema.org/ItemListOrderType
 */
class ItemListOrderType extends Enum
{
    /** @var string An ItemList ordered with higher values listed first. */
    public const ITEM_LIST_ORDER_DESCENDING = 'https://schema.org/ItemListOrderDescending';

    /** @var string An ItemList ordered with lower values listed first. */
    public const ITEM_LIST_ORDER_ASCENDING = 'https://schema.org/ItemListOrderAscending';

    /** @var string An ItemList ordered with no explicit order. */
    public const ITEM_LIST_UNORDERED = 'https://schema.org/ItemListUnordered';
}
