<?php

declare(strict_types=1);

namespace App\Enum;

use MyCLabs\Enum\Enum;

/**
 * Status of a game server.
 *
 * @see https://schema.org/GameServerStatus
 */
class GameServerStatus extends Enum
{
    /** @var string Game server status: OnlineFull. Server is online but unavailable. The maximum number of players has reached. */
    public const ONLINE_FULL = 'https://schema.org/OnlineFull';

    /** @var string Game server status: Online. Server is available. */
    public const ONLINE = 'https://schema.org/Online';

    /** @var string Game server status: OfflinePermanently. Server is offline and not available. */
    public const OFFLINE_PERMANENTLY = 'https://schema.org/OfflinePermanently';

    /** @var string Game server status: OfflineTemporarily. Server is offline now but it can be online soon. */
    public const OFFLINE_TEMPORARILY = 'https://schema.org/OfflineTemporarily';
}
