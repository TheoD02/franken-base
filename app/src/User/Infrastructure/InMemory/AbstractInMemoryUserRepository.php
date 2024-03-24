<?php

namespace App\User\Infrastructure\InMemory;

use App\Shared\Infrastructure\InMemory\AbstractInMemoryRepository;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\UserId;

/**
 * @extends AbstractInMemoryRepository<User>
 */
class AbstractInMemoryUserRepository extends AbstractInMemoryRepository implements UserRepositoryInterface
{
    public function add(User $user): void
    {
        $this->entities[(string)$user->id()] = $user;
    }

    public function remove(User $user): void
    {
        unset($this->entities[(string)$user->id()]);
    }

    public function ofId(UserId $id): ?User
    {
        return $this->entities[(string)$id] ?? null;
    }
}
