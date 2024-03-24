<?php

declare(strict_types=1);

namespace App\User\Application\Command;

use App\Shared\Application\Command\AsCommandHandler;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepositoryInterface;
use App\User\Domain\ValueObject\UserRoles;

#[AsCommandHandler]
final readonly class CreateUserCommandHandler
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {
    }

    public function __invoke(CreateUserCommand $command): User
    {
        $user = new User(email: $command->email, password: $command->password, roles: $command->roles ?? new UserRoles([UserRoles::ROLE_USER]));

        $this->repository->add($user);

        return $user;
    }
}
