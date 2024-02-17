<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates common size systems specific for wearable products.
 *
 * @see https://schema.org/WearableSizeSystemEnumeration
 */
class WearableSizeSystemEnumeration extends Enum
{
    /** @var string German size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_D_E = 'https://schema.org/WearableSizeSystemDE';

    /** @var string GS1 (formerly NRF) size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_G_S1 = 'https://schema.org/WearableSizeSystemGS1';

    /** @var string EN 13402 (joint European standard for size labelling of clothes). */
    public const WEARABLE_SIZE_SYSTEM_E_N13402 = 'https://schema.org/WearableSizeSystemEN13402';

    /** @var string European size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_EUROPE = 'https://schema.org/WearableSizeSystemEurope';

    /** @var string Mexican size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_M_X = 'https://schema.org/WearableSizeSystemMX';

    /** @var string Italian size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_I_T = 'https://schema.org/WearableSizeSystemIT';

    /** @var string United Kingdom size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_U_K = 'https://schema.org/WearableSizeSystemUK';

    /** @var string Continental size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_CONTINENTAL = 'https://schema.org/WearableSizeSystemContinental';

    /** @var string Australian size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_A_U = 'https://schema.org/WearableSizeSystemAU';

    /** @var string United States size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_U_S = 'https://schema.org/WearableSizeSystemUS';

    /** @var string Brazilian size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_B_R = 'https://schema.org/WearableSizeSystemBR';

    /** @var string French size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_F_R = 'https://schema.org/WearableSizeSystemFR';

    /** @var string Chinese size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_C_N = 'https://schema.org/WearableSizeSystemCN';

    /** @var string Japanese size system for wearables. */
    public const WEARABLE_SIZE_SYSTEM_J_P = 'https://schema.org/WearableSizeSystemJP';
}
