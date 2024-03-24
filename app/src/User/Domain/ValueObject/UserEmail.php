<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

#[ORM\Embeddable]
final class UserEmail
{
    public function __construct(
        #[ORM\Column(name: 'email', type: 'string', length: 180, unique: true)]
        public string $value
    ) {
        Assert::email($value);
    }
}
