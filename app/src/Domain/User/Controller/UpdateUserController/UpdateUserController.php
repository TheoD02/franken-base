<?php

declare(strict_types=1);

namespace App\Domain\User\Controller\UpdateUserController;

use App\Domain\User\Exception\UserNotFoundException;
use App\Domain\User\Serialization\UserGroups;
use App\Domain\User\Service\UserService;
use App\Domain\User\ValueObject\User;
use App\Trait\EntityManagerTrait;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

/**
 * @see \App\Tests\User\Controller\UpdateUserControllerTest
 */
#[AsController]
#[ApiRoute('/api/users/{id}', httpMethodEnum: HttpMethodEnum::PATCH)]
class UpdateUserController
{
    use EntityManagerTrait;

    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    #[ApiException(UserNotFoundException::class)]
    public function __invoke(#[MapRequestPayload] UpdateUserPayload $payload, int $id, UserService $userService): ApiResponse
    {
        $user = $userService->update($id, $payload);

        return new ApiResponse(data: $user, groups: [UserGroups::READ, UserGroups::READ_ROLES]);
    }
}
