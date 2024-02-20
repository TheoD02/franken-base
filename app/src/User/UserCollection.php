<?php

namespace App\User;

use App\Api\ApiDataCollectionInterface;
use loophp\collection\CollectionDecorator;

class UserCollection extends CollectionDecorator implements ApiDataCollectionInterface
{

}