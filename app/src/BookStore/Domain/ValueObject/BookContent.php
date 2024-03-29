<?php

declare(strict_types=1);

namespace App\BookStore\Domain\ValueObject;

use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

#[ORM\Embeddable]
final class BookContent
{
    #[ORM\Column(name: 'content', length: 5000)]
    public readonly string $value;

    public function __construct(
        string $value
    ) {
        Assert::lengthBetween($value, 1, 5000);

        $this->value = $value;
    }
}
