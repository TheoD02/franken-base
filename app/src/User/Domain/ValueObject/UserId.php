<?php

namespace App\User\Domain\ValueObject;

use App\Shared\Domain\ValueObject\AggregateRootIdTrait;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
final class UserId implements \Stringable
{
    use AggregateRootIdTrait;
}
