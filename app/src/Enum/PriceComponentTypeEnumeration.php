<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates different price components that together make up the total price for an offered product.
 *
 * @see https://schema.org/PriceComponentTypeEnumeration
 */
class PriceComponentTypeEnumeration extends Enum
{
    /** @var string Represents the downpayment (up-front payment) price component of the total price for an offered product that has additional installment payments. */
    public const DOWNPAYMENT = 'https://schema.org/Downpayment';

    /** @var string Represents the subscription pricing component of the total price for an offered product. */
    public const SUBSCRIPTION = 'https://schema.org/Subscription';

    /** @var string Represents the activation fee part of the total price for an offered product, for example a cellphone contract. */
    public const ACTIVATION_FEE = 'https://schema.org/ActivationFee';

    /** @var string Represents the installment pricing component of the total price for an offered product. */
    public const INSTALLMENT = 'https://schema.org/Installment';

    /** @var string Represents the cleaning fee part of the total price for an offered product, for example a vacation rental. */
    public const CLEANING_FEE = 'https://schema.org/CleaningFee';

    /** @var string Represents the distance fee (e.g., price per km or mile) part of the total price for an offered product, for example a car rental. */
    public const DISTANCE_FEE = 'https://schema.org/DistanceFee';
}
