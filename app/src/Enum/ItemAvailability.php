<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A list of possible product availability options.
 *
 * @see https://schema.org/ItemAvailability
 */
class ItemAvailability extends Enum
{
    /** @var string Indicates that the item is in stock. */
    public const IN_STOCK = 'https://schema.org/InStock';

    /** @var string Indicates that the item has sold out. */
    public const SOLD_OUT = 'https://schema.org/SoldOut';

    /** @var string Indicates that the item has been discontinued. */
    public const DISCONTINUED = 'https://schema.org/Discontinued';

    /** @var string Indicates that the item is out of stock. */
    public const OUT_OF_STOCK = 'https://schema.org/OutOfStock';

    /** @var string Indicates that the item is available on back order. */
    public const BACK_ORDER = 'https://schema.org/BackOrder';

    /** @var string Indicates that the item is available only at physical locations. */
    public const IN_STORE_ONLY = 'https://schema.org/InStoreOnly';

    /** @var string Indicates that the item is available for pre-order. */
    public const PRE_ORDER = 'https://schema.org/PreOrder';

    /** @var string Indicates that the item is available for ordering and delivery before general availability. */
    public const PRE_SALE = 'https://schema.org/PreSale';

    /** @var string Indicates that the item has limited availability. */
    public const LIMITED_AVAILABILITY = 'https://schema.org/LimitedAvailability';

    /** @var string Indicates that the item is available only online. */
    public const ONLINE_ONLY = 'https://schema.org/OnlineOnly';
}
