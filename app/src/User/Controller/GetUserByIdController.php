<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Entity\User;
use App\Trait\EntityManagerTrait;
use App\User\Exception\UserNotFound;
use App\User\UserGroups;
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
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    public function __invoke(int $id): ApiResponse
    {
        $user = $this->em->find(User::class, $id);

        if ($user === null) {
            throw new UserNotFound([
                'userId' => $id,
            ]);
        }

        return new ApiResponse(data: $user, groups: [UserGroups::READ]);
    }
}
