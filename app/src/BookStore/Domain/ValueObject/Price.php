<?php

declare(strict_types=1);

namespace App\BookStore\Domain\ValueObject;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

#[ORM\Embeddable]
final class Price
{
    #[ORM\Column(name: 'price', type: Types::INTEGER, options: [
        'unsigned' => true,
    ])]
    public readonly int $amount;

    public function __construct(
        int $amount
    ) {
        Assert::greaterThanEq($amount, 0);

        $this->amount = $amount;
    }

    public function applyDiscount(Discount $discount): static
    {
        $amount = (int) ($this->amount - ($this->amount * $discount->percentage / 100));

        return new self($amount);
    }
}
