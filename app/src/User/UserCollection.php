<?php

declare(strict_types=1);

namespace App\User;

use loophp\collection\CollectionDecorator;
use Module\Api\Adapter\ApiDataCollectionInterface;

/**
 * @extends CollectionDecorator<User>
 */
class UserCollection extends CollectionDecorator implements ApiDataCollectionInterface
{
}
