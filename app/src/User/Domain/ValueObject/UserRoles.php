<?php

declare(strict_types=1);

namespace App\User\Domain\ValueObject;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Webmozart\Assert\Assert;

#[ORM\Embeddable]
final class UserRoles
{
    public const ROLE_USER = 'ROLE_USER';

    /**
     * @param array<string> $value
     */
    public function __construct(
        #[ORM\Column(name: 'roles', type: Types::JSON)]
        public array $value
    ) {
        Assert::isNonEmptyList($value);
        Assert::allStartsWith($value, 'ROLE_');
    }

    public function add(string $role): void
    {
        $this->value[] = $role;
    }

    public function remove(string $role): void
    {
        $key = array_search($role, $this->value, true);
        if ($key !== false) {
            unset($this->value[$key]);
        }
    }

    public function has(string $role): bool
    {
        return \in_array($role, $this->value, true);
    }

    public function equals(self $roles): bool
    {
        return array_values($this->value) === array_values($roles->value);
    }
}
