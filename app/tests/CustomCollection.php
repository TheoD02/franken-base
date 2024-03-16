<?php

namespace App\Tests;

use App\User\ValueObject\User;

class CustomCollection extends \Arrayy\Collection\AbstractCollection
{
    #[\Override]
    public function getType()
    {
        return User::class;
    }
}