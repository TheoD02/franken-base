<?php

namespace App\User;

use App\Api\Adapter\ApiDataCollectionInterface;
use loophp\collection\CollectionDecorator;

/**
 * @extends CollectionDecorator<User>
 */
class UserCollection extends CollectionDecorator implements ApiDataCollectionInterface
{

}