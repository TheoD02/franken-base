<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Entity\User;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::GET)]
class GetUserByIdController
{
    /**
     * @return ApiResponse<User, null>
     */
    #[OpenApiResponse(User::class)]
    public function __invoke(User $user): ApiResponse
    {
        return new ApiResponse(data: $user);
    }
}
