<?php

declare(strict_types=1);

namespace Module\Api\Adapter;

use loophp\collection\Contract\Collection;

/**
 * Use this interface to mark a class as valid to be used as a response data collection.
 */
interface ApiDataCollectionInterface extends Collection
{
}
