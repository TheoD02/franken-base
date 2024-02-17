<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates different price types, for example list price, invoice price, and sale price.
 *
 * @see https://schema.org/PriceTypeEnumeration
 */
class PriceTypeEnumeration extends Enum
{
    /** @var string Represents the invoice price of an offered product. */
    public const INVOICE_PRICE = 'https://schema.org/InvoicePrice';

    /** @var string Represents the list price (the price a product is actually advertised for) of an offered product. */
    public const LIST_PRICE = 'https://schema.org/ListPrice';

    /** @var string Represents a sale price (usually active for a limited period) of an offered product. */
    public const SALE_PRICE = 'https://schema.org/SalePrice';

    /** @var string Represents the suggested retail price ("SRP") of an offered product. */
    public const S_R_P = 'https://schema.org/SRP';

    /** @var string Represents the manufacturer suggested retail price ("MSRP") of an offered product. */
    public const M_S_R_P = 'https://schema.org/MSRP';

    /** @var string Represents the minimum advertised price ("MAP") (as dictated by the manufacturer) of an offered product. */
    public const MINIMUM_ADVERTISED_PRICE = 'https://schema.org/MinimumAdvertisedPrice';
}
