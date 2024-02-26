<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\User;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::PUT)]
class UpdateUserController
{
    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    public function __invoke(int $id, #[MapRequestPayload] User $user): ApiResponse
    {
        return new ApiResponse($user);
    }
}
