<?php

declare(strict_types=1);

namespace App\User\Controller;

use Module\Api\ApiResponse;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::DELETE)]
class DeleteUserByIdController
{
    public function __invoke(int $id): ApiResponse
    {
        return new ApiResponse(null, status: 204);
    }
}
