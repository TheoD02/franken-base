<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Trait\EntityManagerTrait;
use App\User\Entity\UserEntity;
use App\User\Exception\UserNotFoundException;
use App\User\Serialization\UserGroups;
use App\User\Service\UserService;
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
    use EntityManagerTrait;

    /**
     * @return ApiResponse<UserEntity, null>
     */
    #[OpenApiResponse(UserEntity::class)]
    public function __invoke(int $id, UserService $userService): ApiResponse
    {
        $user = $userService->getOneByIdOrFail($id);

        return new ApiResponse(data: $user, groups: [UserGroups::READ]);
    }
}
