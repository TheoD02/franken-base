<?php

declare(strict_types=1);

namespace App\User\Controller\UpdateUserController;

use App\Trait\EntityManagerTrait;
use App\User\Exception\UserNotFoundException;
use App\User\Serialization\UserGroups;
use App\User\Service\UserService;
use App\User\ValueObject\User;
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
