<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * The status of an Action.
 *
 * @see https://schema.org/ActionStatusType
 */
class ActionStatusType extends Enum
{
    /** @var string An action that failed to complete. The action's error property and the HTTP return code contain more information about the failure. */
    public const FAILED_ACTION_STATUS = 'https://schema.org/FailedActionStatus';

    /** @var string An in-progress action (e.g., while watching the movie, or driving to a location). */
    public const ACTIVE_ACTION_STATUS = 'https://schema.org/ActiveActionStatus';

    /** @var string A description of an action that is supported. */
    public const POTENTIAL_ACTION_STATUS = 'https://schema.org/PotentialActionStatus';

    /** @var string An action that has already taken place. */
    public const COMPLETED_ACTION_STATUS = 'https://schema.org/CompletedActionStatus';
}
