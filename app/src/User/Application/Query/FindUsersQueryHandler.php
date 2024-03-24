<?php

declare(strict_types=1);

namespace App\User\Application\Query;

use App\Shared\Application\Query\AsQueryHandler;
use App\User\Domain\Repository\UserRepositoryInterface;

#[AsQueryHandler]
final readonly class FindUsersQueryHandler
{
    public function __construct(
        private UserRepositoryInterface $repository
    ) {
    }

    public function __invoke(FindUsersQuery $query): UserRepositoryInterface
    {
        $repository = $this->repository;

        if ($query->page !== null && $query->itemsPerPage !== null) {
            return $repository->withPagination($query->page, $query->itemsPerPage);
        }

        return $repository;
    }
}
