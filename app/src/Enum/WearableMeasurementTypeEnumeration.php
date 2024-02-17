<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates common types of measurement for wearables products.
 *
 * @see https://schema.org/WearableMeasurementTypeEnumeration
 */
class WearableMeasurementTypeEnumeration extends Enum
{
    /** @var string Measurement of the back section, for example of a jacket. */
    public const WEARABLE_MEASUREMENT_BACK = 'https://schema.org/WearableMeasurementBack';

    /** @var string Represents the length, for example of a dress. */
    public const WEARABLE_MEASUREMENT_LENGTH = 'https://schema.org/WearableMeasurementLength';

    /** @var string Measurement of the sleeve length, for example of a shirt. */
    public const WEARABLE_MEASUREMENT_SLEEVE = 'https://schema.org/WearableMeasurementSleeve';

    /** @var string Measurement of the width, for example of shoes. */
    public const WEARABLE_MEASUREMENT_WIDTH = 'https://schema.org/WearableMeasurementWidth';

    /** @var string Measurement of the waist section, for example of pants. */
    public const WEARABLE_MEASUREMENT_WAIST = 'https://schema.org/WearableMeasurementWaist';

    /** @var string Measurement of the collar, for example of a shirt. */
    public const WEARABLE_MEASUREMENT_COLLAR = 'https://schema.org/WearableMeasurementCollar';

    /** @var string Measurement of the cup, for example of a bra. */
    public const WEARABLE_MEASUREMENT_CUP = 'https://schema.org/WearableMeasurementCup';

    /** @var string Measurement of the inseam, for example of pants. */
    public const WEARABLE_MEASUREMENT_INSEAM = 'https://schema.org/WearableMeasurementInseam';

    /** @var string Measurement of the height, for example the heel height of a shoe. */
    public const WEARABLE_MEASUREMENT_HEIGHT = 'https://schema.org/WearableMeasurementHeight';

    /** @var string Measurement of the hip section, for example of a skirt. */
    public const WEARABLE_MEASUREMENT_HIPS = 'https://schema.org/WearableMeasurementHips';

    /** @var string Measurement of the chest/bust section, for example of a suit. */
    public const WEARABLE_MEASUREMENT_CHEST_OR_BUST = 'https://schema.org/WearableMeasurementChestOrBust';

    /** @var string Measurement of the outside leg, for example of pants. */
    public const WEARABLE_MEASUREMENT_OUTSIDE_LEG = 'https://schema.org/WearableMeasurementOutsideLeg';
}
