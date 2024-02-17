<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates common size groups (also known as "size types") for wearable products.
 *
 * @see https://schema.org/WearableSizeGroupEnumeration
 */
class WearableSizeGroupEnumeration extends Enum
{
    /** @var string Size group "Misses" (also known as "Missy") for wearables. */
    public const WEARABLE_SIZE_GROUP_MISSES = 'https://schema.org/WearableSizeGroupMisses';

    /** @var string Size group "Girls" for wearables. */
    public const WEARABLE_SIZE_GROUP_GIRLS = 'https://schema.org/WearableSizeGroupGirls';

    /** @var string Size group "Juniors" for wearables. */
    public const WEARABLE_SIZE_GROUP_JUNIORS = 'https://schema.org/WearableSizeGroupJuniors';

    /** @var string Size group "Extra Short" for wearables. */
    public const WEARABLE_SIZE_GROUP_EXTRA_SHORT = 'https://schema.org/WearableSizeGroupExtraShort';

    /** @var string Size group "Womens" for wearables. */
    public const WEARABLE_SIZE_GROUP_WOMENS = 'https://schema.org/WearableSizeGroupWomens';

    /** @var string Size group "Tall" for wearables. */
    public const WEARABLE_SIZE_GROUP_TALL = 'https://schema.org/WearableSizeGroupTall';

    /** @var string Size group "Infants" for wearables. */
    public const WEARABLE_SIZE_GROUP_INFANTS = 'https://schema.org/WearableSizeGroupInfants';

    /** @var string Size group "Maternity" for wearables. */
    public const WEARABLE_SIZE_GROUP_MATERNITY = 'https://schema.org/WearableSizeGroupMaternity';

    /** @var string Size group "Big" for wearables. */
    public const WEARABLE_SIZE_GROUP_BIG = 'https://schema.org/WearableSizeGroupBig';

    /** @var string Size group "Plus" for wearables. */
    public const WEARABLE_SIZE_GROUP_PLUS = 'https://schema.org/WearableSizeGroupPlus';

    /** @var string Size group "Husky" (or "Stocky") for wearables. */
    public const WEARABLE_SIZE_GROUP_HUSKY = 'https://schema.org/WearableSizeGroupHusky';

    /** @var string Size group "Boys" for wearables. */
    public const WEARABLE_SIZE_GROUP_BOYS = 'https://schema.org/WearableSizeGroupBoys';

    /** @var string Size group "Extra Tall" for wearables. */
    public const WEARABLE_SIZE_GROUP_EXTRA_TALL = 'https://schema.org/WearableSizeGroupExtraTall';

    /** @var string Size group "Mens" for wearables. */
    public const WEARABLE_SIZE_GROUP_MENS = 'https://schema.org/WearableSizeGroupMens';

    /** @var string Size group "Short" for wearables. */
    public const WEARABLE_SIZE_GROUP_SHORT = 'https://schema.org/WearableSizeGroupShort';

    /** @var string Size group "Petite" for wearables. */
    public const WEARABLE_SIZE_GROUP_PETITE = 'https://schema.org/WearableSizeGroupPetite';

    /** @var string Size group "Regular" for wearables. */
    public const WEARABLE_SIZE_GROUP_REGULAR = 'https://schema.org/WearableSizeGroupRegular';
}
