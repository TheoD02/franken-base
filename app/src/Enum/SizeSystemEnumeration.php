<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates common size systems for different categories of products, for example "EN-13402" or "UK" for wearables or "Imperial" for screws.
 *
 * @see https://schema.org/SizeSystemEnumeration
 */
class SizeSystemEnumeration extends Enum
{
    /** @var string Metric size system. */
    public const SIZE_SYSTEM_METRIC = 'https://schema.org/SizeSystemMetric';

    /** @var string Imperial size system. */
    public const SIZE_SYSTEM_IMPERIAL = 'https://schema.org/SizeSystemImperial';
}
