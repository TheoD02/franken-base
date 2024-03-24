<?php

declare(strict_types=1);

namespace App\User\Domain\Model;

use App\User\Domain\ValueObject\UserEmail;
use App\User\Domain\ValueObject\UserId;
use App\User\Domain\ValueObject\UserPassword;
use App\User\Domain\ValueObject\UserRoles;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Security\Core\User\UserInterface;

#[Entity]
final readonly class User implements UserInterface
{
    #[ORM\Embedded(columnPrefix: false)]
    private UserId $id;

    public function __construct(
        #[ORM\Embedded(columnPrefix: false)]
        private UserEmail $email,

        #[ORM\Embedded(columnPrefix: false)]
        private UserPassword $password,

        #[ORM\Embedded(columnPrefix: false)]
        private UserRoles $roles,
    ) {
        $this->id = new UserId();
    }

    public function id(): UserId
    {
        return $this->id;
    }

    public function email(): UserEmail
    {
        return $this->email;
    }

    public function password(): UserPassword
    {
        return $this->password;
    }

    public function roles(): UserRoles
    {
        return $this->roles;
    }

    public function getRoles(): array
    {
        return $this->roles->value;
    }

    public function eraseCredentials(): void
    {
        // Nothing to do for now
    }

    public function getUserIdentifier(): string
    {
        return (string) $this->id->value;
    }
}
