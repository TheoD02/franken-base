<?php

declare(strict_types=1);

namespace App\User\Controller;

use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Dto\ApiResponse;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::DELETE)]
class DeleteUserByIdController
{
    #[OpenApiResponse(empty: true)]
    public function __invoke(int $id): void
    {
    }
}
