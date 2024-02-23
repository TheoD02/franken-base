<?php

namespace App\User;

use Module\Api\Adapter\ApiDataCollectionInterface;
use loophp\collection\CollectionDecorator;

/**
 * @extends CollectionDecorator<User>
 */
class UserCollection extends CollectionDecorator implements ApiDataCollectionInterface
{

}