<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Enumerates the different statuses of a Certification (Active and Inactive).
 *
 * @see https://schema.org/CertificationStatusEnumeration
 */
class CertificationStatusEnumeration extends Enum
{
    /** @var string Specifies that a certification is inactive (no longer in effect). */
    public const CERTIFICATION_INACTIVE = 'https://schema.org/CertificationInactive';

    /** @var string Specifies that a certification is active. */
    public const CERTIFICATION_ACTIVE = 'https://schema.org/CertificationActive';
}
