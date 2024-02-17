<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * RsvpResponseType is an enumeration type whose instances represent responding to an RSVP request.
 *
 * @see https://schema.org/RsvpResponseType
 */
class RsvpResponseType extends Enum
{
    /** @var string The invitee will attend. */
    public const RSVP_RESPONSE_YES = 'https://schema.org/RsvpResponseYes';

    /** @var string The invitee will not attend. */
    public const RSVP_RESPONSE_NO = 'https://schema.org/RsvpResponseNo';

    /** @var string The invitee may or may not attend. */
    public const RSVP_RESPONSE_MAYBE = 'https://schema.org/RsvpResponseMaybe';
}
