<?php

namespace App\Controller;

use App\Api\ApiResponse;
use App\Api\Attribut\ApiRoute;
use App\Api\Attribut\BadRequestResponse;
use App\Api\Attribut\OpenApiMeta;
use App\Api\Attribut\OpenApiResponse;
use App\Api\Enum\HttpMethod;
use App\Api\Enum\ResponseType;
use App\User\User;
use App\User\UserCollection;
use App\User\UserFilterQuery;
use App\User\UserMeta;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapQueryString;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;

#[AsController]
class UserController
{
    #[ApiRoute('/api/users', method: HttpMethod::GET)]
    #[OpenApiResponse(User::class, type: ResponseType::COLLECTION)]
    #[OpenApiMeta(UserMeta::class)]
    #[BadRequestResponse]
    public function index(#[MapQueryString] ?UserFilterQuery $filterQuery): ApiResponse
    {
        return new ApiResponse(
            UserCollection::fromIterable([
                (new User())->setName('John Doe')->setEmail('john@doe.fr'),
                (new User())->setName('Jane Doe')->setEmail('jane@doe.fr'),
            ]),
        );
    }





























    /**
     * @return ApiResponse<User>
     */
    #[ApiRoute('/api/users/{id}', method: HttpMethod::GET)]
    public function show(int $id): ApiResponse
    {
        return new ApiResponse(
            (new User())->setName('John Doe')->setEmail('john@doe.fr'),
        );
    }

    /**
     * @return ApiResponse<User>
     */
    #[ApiRoute('/api/users', method: HttpMethod::POST)]
    #[BadRequestResponse]
    public function create(#[MapRequestPayload] User $user): ApiResponse
    {
        return new ApiResponse($user);
    }

    /**
     * @return ApiResponse<User>
     */
    #[ApiRoute('/api/users/{id}', method: HttpMethod::PUT)]
    #[BadRequestResponse]
    public function update(int $id, #[MapRequestPayload] User $user): ApiResponse
    {
        return new ApiResponse($user);
    }

    /**
     * @return ApiResponse<User>
     */
    #[ApiRoute('/api/users/{id}', method: HttpMethod::DELETE)]
    public function delete(int $id): ApiResponse
    {
        return new ApiResponse(null, status: 204);
    }
}
