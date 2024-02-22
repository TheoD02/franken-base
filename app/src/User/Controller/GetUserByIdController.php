<?php

namespace App\User\Controller;

use App\Api\ApiResponse;
use App\Api\Attribut\ApiRoute;
use App\Api\Attribut\BadRequestResponse;
use App\Api\Attribut\OpenApiMeta;
use App\Api\Attribut\OpenApiResponse;
use App\Api\Enum\HttpMethod;
use App\Api\Enum\ResponseType;
use App\User\Api\UserFilterQuery;
use App\User\Api\UserMeta;
use App\User\Exception\UserProcessingException;
use App\User\User;
use App\User\UserCollection;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
#[ApiRoute('/api/users/{id}', method: HttpMethod::GET)]
class GetUserByIdController
{
    public function __invoke(int $id, User $user): ApiResponse
    {
        return new ApiResponse(
            (new User())->setName('John Doe')->setEmail('john@doe.fr'),
        );
    }
}
