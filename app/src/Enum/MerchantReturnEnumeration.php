<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates several kinds of product return policies.
 *
 * @see https://schema.org/MerchantReturnEnumeration
 */
class MerchantReturnEnumeration extends Enum
{
    /** @var string Specifies that a product return policy is not provided. */
    public const MERCHANT_RETURN_UNSPECIFIED = 'https://schema.org/MerchantReturnUnspecified';

    /** @var string Specifies that there is an unlimited window for product returns. */
    public const MERCHANT_RETURN_UNLIMITED_WINDOW = 'https://schema.org/MerchantReturnUnlimitedWindow';

    /** @var string Specifies that product returns are not permitted. */
    public const MERCHANT_RETURN_NOT_PERMITTED = 'https://schema.org/MerchantReturnNotPermitted';

    /** @var string Specifies that there is a finite window for product returns. */
    public const MERCHANT_RETURN_FINITE_RETURN_WINDOW = 'https://schema.org/MerchantReturnFiniteReturnWindow';
}
