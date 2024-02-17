<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Categories of medical devices, organized by the purpose or intended use of the device.
 *
 * @see https://schema.org/MedicalDevicePurpose
 */
class MedicalDevicePurpose extends Enum
{
    /** @var string A medical device used for therapeutic purposes. */
    public const THERAPEUTIC = 'https://schema.org/Therapeutic';

    /** @var string A medical device used for diagnostic purposes. */
    public const DIAGNOSTIC = 'https://schema.org/Diagnostic';
}
