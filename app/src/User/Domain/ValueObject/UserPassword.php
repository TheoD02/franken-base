<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

#[ORM\Embeddable]
final class UserPassword
{
    public function __construct(
        #[\SensitiveParameter]
        #[ORM\Column(name: 'password')]
        public string $value
    ) {
        Assert::notEmpty($value);
    }
}
