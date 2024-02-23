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
use App\User\User;
use App\User\UserCollection;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;

#[AsController]
#[ApiRoute('/api/users', method: HttpMethod::GET)]
class GetCollectionUserController
{
    #[OpenApiResponse(User::class, type: ResponseType::COLLECTION)]
    #[OpenApiMeta(UserMeta::class)]
    #[BadRequestResponse]
    public function __invoke(
        #[MapQueryString(validationFailedStatusCode: 400)] ?UserFilterQuery $filterQuery
    ): ApiResponse {
        return new ApiResponse(
            UserCollection::fromIterable([
                (new User())->setName('John Doe')->setEmail('john@doe.fr'),
                (new User())->setName('Alice Cooper')->setEmail('alice@cooper.fr'),
            ]),

        );
    }
}