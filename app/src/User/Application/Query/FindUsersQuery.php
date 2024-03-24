<?php

declare(strict_types=1);

namespace App\User\Application\Query;

use App\Shared\Application\Query\QueryInterface;
use App\User\Domain\Repository\UserRepositoryInterface;

/**
 * @implements QueryInterface<UserRepositoryInterface>
 */
final readonly class FindUsersQuery implements QueryInterface
{
    public function __construct(
        public ?int $page = null,
        public ?int $itemsPerPage = null,
    ) {
    }
}
