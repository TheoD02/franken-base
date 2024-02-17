<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates several kinds of policies for product return fees.
 *
 * @see https://schema.org/ReturnFeesEnumeration
 */
class ReturnFeesEnumeration extends Enum
{
    /** @var string Specifies that the customer must pay the return shipping costs when returning a product. */
    public const RETURN_SHIPPING_FEES = 'https://schema.org/ReturnShippingFees';

    /** @var string Specifies that product returns are free of charge for the customer. */
    public const FREE_RETURN = 'https://schema.org/FreeReturn';

    /** @var string Specifies that the customer must pay the original shipping costs when returning a product. */
    public const ORIGINAL_SHIPPING_FEES = 'https://schema.org/OriginalShippingFees';

    /** @var string Specifies that product returns must be paid for, and are the responsibility of, the customer. */
    public const RETURN_FEES_CUSTOMER_RESPONSIBILITY = 'https://schema.org/ReturnFeesCustomerResponsibility';

    /** @var string Specifies that the customer must pay a restocking fee when returning a product. */
    public const RESTOCKING_FEES = 'https://schema.org/RestockingFees';
}
