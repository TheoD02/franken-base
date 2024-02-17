<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A diet restricted to certain foods or preparations for cultural, religious, health or lifestyle reasons.
 *
 * @see https://schema.org/RestrictedDiet
 */
class RestrictedDiet extends Enum
{
    /** @var string A diet exclusive of animal meat. */
    public const VEGETARIAN_DIET = 'https://schema.org/VegetarianDiet';

    /** @var string A diet conforming to Islamic dietary practices. */
    public const HALAL_DIET = 'https://schema.org/HalalDiet';

    /** @var string A diet conforming to Jewish dietary practices. */
    public const KOSHER_DIET = 'https://schema.org/KosherDiet';

    /** @var string A diet focused on reduced fat and cholesterol intake. */
    public const LOW_FAT_DIET = 'https://schema.org/LowFatDiet';

    /** @var string A diet exclusive of all animal products. */
    public const VEGAN_DIET = 'https://schema.org/VeganDiet';

    /** @var string A diet appropriate for people with lactose intolerance. */
    public const LOW_LACTOSE_DIET = 'https://schema.org/LowLactoseDiet';

    /** @var string A diet exclusive of gluten. */
    public const GLUTEN_FREE_DIET = 'https://schema.org/GlutenFreeDiet';

    /** @var string A diet focused on reduced calorie intake. */
    public const LOW_CALORIE_DIET = 'https://schema.org/LowCalorieDiet';

    /** @var string A diet conforming to Hindu dietary practices, in particular, beef-free. */
    public const HINDU_DIET = 'https://schema.org/HinduDiet';

    /** @var string A diet focused on reduced sodium intake. */
    public const LOW_SALT_DIET = 'https://schema.org/LowSaltDiet';

    /** @var string A diet appropriate for people with diabetes. */
    public const DIABETIC_DIET = 'https://schema.org/DiabeticDiet';
}
