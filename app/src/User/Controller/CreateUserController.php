<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\User\Api\UserFilterQuery;
use App\User\Exception\UserNotFound;
use App\User\Exception\UserProcessingException;
use App\User\User;
use Module\Api\ApiResponse;
use Module\Api\Attribut\ApiException;
use Module\Api\Attribut\ApiRoute;
use Module\Api\Attribut\OpenApiResponse;
use Module\Api\Enum\HttpMethod;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
#[ApiRoute('/api/users', method: HttpMethod::POST)]
class CreateUserController
{
    #[OpenApiResponse(User::class)]
    #[ApiException(UserProcessingException::class)]
    #[ApiException(UserNotFound::class)]
    public function __invoke(
        #[MapRequestPayload] User $user,
        #[MapQueryString(validationFailedStatusCode: 400)] ?UserFilterQuery $filterQuery
    ): ApiResponse {
        return new ApiResponse($user);
    }
}
