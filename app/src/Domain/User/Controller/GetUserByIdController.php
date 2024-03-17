<?php

declare(strict_types=1);

namespace App\Domain\User\Controller;

use App\Domain\User\Serialization\UserGroups;
use App\Domain\User\Service\UserService;
use App\Domain\User\ValueObject\User;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethodEnum;
use Symfony\Component\HttpKernel\Attribute\AsController;

/**
 * @see \App\Tests\User\Controller\GetUserByIdControllerTest
 */
#[AsController]
#[ApiRoute('/api/users/{id}', httpMethodEnum: HttpMethodEnum::GET)]
class GetUserByIdController
{
    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    public function __invoke(int $id, UserService $userService): ApiResponse
    {
        $user = $userService->getOneByIdOrFail($id);

        return new ApiResponse(data: $user, groups: [UserGroups::READ]);
    }
}
