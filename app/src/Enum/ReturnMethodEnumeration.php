<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates several types of product return methods.
 *
 * @see https://schema.org/ReturnMethodEnumeration
 */
class ReturnMethodEnumeration extends Enum
{
    /** @var string Specifies that the consumer can keep the product, even when receiving a refund or store credit. */
    public const KEEP_PRODUCT = 'https://schema.org/KeepProduct';

    /** @var string Specifies that product returns must be made in a store. */
    public const RETURN_IN_STORE = 'https://schema.org/ReturnInStore';

    /** @var string Specifies that product returns must be done by mail. */
    public const RETURN_BY_MAIL = 'https://schema.org/ReturnByMail';

    /** @var string Specifies that product returns must be made at a kiosk. */
    public const RETURN_AT_KIOSK = 'https://schema.org/ReturnAtKiosk';
}
