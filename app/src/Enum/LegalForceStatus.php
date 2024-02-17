<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * A list of possible statuses for the legal force of a legislation.
 *
 * @see https://schema.org/LegalForceStatus
 */
class LegalForceStatus extends Enum
{
    /** @var string Indicates that parts of the legislation are in force, and parts are not. */
    public const PARTIALLY_IN_FORCE = 'https://schema.org/PartiallyInForce';

    /** @var string Indicates that a legislation is currently not in force. */
    public const NOT_IN_FORCE = 'https://schema.org/NotInForce';

    /** @var string Indicates that a legislation is in force. */
    public const IN_FORCE = 'https://schema.org/InForce';
}
