<?php

namespace App\User\Application\Query;

use App\Shared\Application\Query\AsQueryHandler;
use App\User\Domain\Exception\MissingUserException;
use App\User\Domain\Model\User;
use App\User\Domain\Repository\UserRepositoryInterface;

#[AsQueryHandler]
final readonly class FindUserQueryHandler
{
    public function __construct(private UserRepositoryInterface $userRepository)
    {
    }

    public function __invoke(FindUserQuery $query): User
    {
        $user = $this->userRepository->ofId($query->id);

        if ($user === null) {
            throw new MissingUserException($query->id);
        }

        return $user;
    }
}
