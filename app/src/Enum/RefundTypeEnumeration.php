<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates several kinds of product return refund types.
 *
 * @see https://schema.org/RefundTypeEnumeration
 */
class RefundTypeEnumeration extends Enum
{
    /** @var string Specifies that a refund can be done as an exchange for the same product. */
    public const EXCHANGE_REFUND = 'https://schema.org/ExchangeRefund';

    /** @var string Specifies that a refund can be done in the full amount the customer paid for the product. */
    public const FULL_REFUND = 'https://schema.org/FullRefund';

    /** @var string Specifies that the customer receives a store credit as refund when returning a product. */
    public const STORE_CREDIT_REFUND = 'https://schema.org/StoreCreditRefund';
}
