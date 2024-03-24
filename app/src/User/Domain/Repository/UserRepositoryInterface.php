<?php

namespace App\User\Domain\Repository;

use App\Shared\Domain\Repository\RepositoryInterface;
use App\User\Domain\Model\User;
use App\User\Domain\ValueObject\UserId;

/**
 * @extends RepositoryInterface<User>
 */
interface UserRepositoryInterface extends RepositoryInterface
{
    public function add(User $user): void;

    public function remove(User $user): void;

    public function ofId(UserId $id): ?User;
}
