<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * UKNonprofitType: Non-profit organization type originating from the United Kingdom.
 *
 * @see https://schema.org/UKNonprofitType
 */
class UKNonprofitType extends Enum
{
    /** @var string CharitableIncorporatedOrganization: Non-profit type referring to a Charitable Incorporated Organization (UK). */
    public const CHARITABLE_INCORPORATED_ORGANIZATION = 'https://schema.org/CharitableIncorporatedOrganization';

    /** @var string UKTrust: Non-profit type referring to a UK trust. */
    public const U_K_TRUST = 'https://schema.org/UKTrust';

    /** @var string LimitedByGuaranteeCharity: Non-profit type referring to a charitable company that is limited by guarantee (UK). */
    public const LIMITED_BY_GUARANTEE_CHARITY = 'https://schema.org/LimitedByGuaranteeCharity';

    /** @var string UnincorporatedAssociationCharity: Non-profit type referring to a charitable company that is not incorporated (UK). */
    public const UNINCORPORATED_ASSOCIATION_CHARITY = 'https://schema.org/UnincorporatedAssociationCharity';
}
