<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * GovernmentBenefitsType enumerates several kinds of government benefits to support the COVID-19 situation. Note that this structure may not capture all benefits offered.
 *
 * @see https://schema.org/GovernmentBenefitsType
 */
class GovernmentBenefitsType extends Enum
{
    /** @var string ParentalSupport: this is a benefit for parental support. */
    public const PARENTAL_SUPPORT = 'https://schema.org/ParentalSupport';

    /** @var string BusinessSupport: this is a benefit for supporting businesses. */
    public const BUSINESS_SUPPORT = 'https://schema.org/BusinessSupport';

    /** @var string PaidLeave: this is a benefit for paid leave. */
    public const PAID_LEAVE = 'https://schema.org/PaidLeave';

    /** @var string DisabilitySupport: this is a benefit for disability support. */
    public const DISABILITY_SUPPORT = 'https://schema.org/DisabilitySupport';

    /** @var string UnemploymentSupport: this is a benefit for unemployment support. */
    public const UNEMPLOYMENT_SUPPORT = 'https://schema.org/UnemploymentSupport';

    /** @var string HealthCare: this is a benefit for health care. */
    public const HEALTH_CARE = 'https://schema.org/HealthCare';

    /** @var string BasicIncome: this is a benefit for basic income. */
    public const BASIC_INCOME = 'https://schema.org/BasicIncome';

    /** @var string OneTimePayments: this is a benefit for one-time payments for individuals. */
    public const ONE_TIME_PAYMENTS = 'https://schema.org/OneTimePayments';
}
