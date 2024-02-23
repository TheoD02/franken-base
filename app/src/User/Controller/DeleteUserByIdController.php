<?php

namespace App\User\Controller;

use Module\Api\ApiResponse;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\BadRequestResponse;
use Module\Api\Attribut\OpenApiMeta;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Enum\HttpMethod;
use Module\Api\Enum\ResponseType;
use App\User\Api\UserFilterQuery;
use App\User\Api\UserMeta;
use App\User\Exception\UserProcessingException;
use App\User\User;
use App\User\UserCollection;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::DELETE)]
class DeleteUserByIdController
{
    public function __invoke(int $id): ApiResponse
    {
        return new ApiResponse(null, status: 204);
    }
}