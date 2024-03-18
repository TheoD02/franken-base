<?php

namespace App\Domain\User\ApiState;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\Pagination\PaginatorInterface;
use ApiPlatform\State\ProviderInterface;
use App\Domain\User\ApiResource\UserDto;
use App\Domain\User\Repository\UserRepository;
use App\Domain\User\Service\UserService;
use Rekalogika\ApiLite\State\AbstractProvider;

/**
 * @extends AbstractProvider<UserDto>
 */
class UserCollectionProvider extends AbstractProvider
{
    public function __construct(
        private readonly UserService $userService,
    ) {
    }

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): object|array|null
    {
        return $this->userService->paginate($operation);
    }
}
