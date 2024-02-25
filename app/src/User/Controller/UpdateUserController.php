<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\User;
use Module\Api\ApiResponse;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::PUT)]
class UpdateUserController
{
    public function __invoke(int $id, #[MapRequestPayload] User $user): ApiResponse
    {
        return new ApiResponse($user);
    }
}
