<?php

declare(strict_types=1);

namespace App\User\Controller\CreateUserController;

use App\User\Exception\UserNotFoundException;
use App\User\Serialization\UserGroups;
use App\User\Service\UserService;
use App\User\ValueObject\User;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Module\Api\Enum\HttpStatusEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

/**
 * @see \App\Tests\User\Controller\CreateUserControllerTest
 */
#[AsController]
#[ApiRoute('/api/users', httpMethodEnum: HttpMethodEnum::POST)]
class CreateUserController
{
    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    #[ApiException(UserNotFoundException::class)]
    public function __invoke(#[MapRequestPayload] CreateUserPayload $createUserPayload, UserService $userService): ApiResponse
    {
        $user = $userService->create($createUserPayload);

        return new ApiResponse(data: $user, groups: [UserGroups::READ, UserGroups::READ_ROLES], httpStatusEnum: HttpStatusEnum::CREATED);
    }
}
